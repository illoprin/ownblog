import esbuild from "esbuild";
import fg from "fast-glob";
import path from "node:path";
import fs from "node:fs/promises";
import chokidar from "chokidar";
import { BuildBootstrap } from "./build-bootstrap.mjs";

const SRC_DIR = "assets/src";
const DIST_DIR = "assets/dist";

const isWatch = process.argv.includes("--watch");

function isAlreadyMinified(file) {
  // например: bootstrap.min.css, jquery.min.js
  return /\.min\.(js|css)$/i.test(file);
}

async function run() {
  await BuildBootstrap();

  const jsFiles = await fg(`${SRC_DIR}/**/*.js`);
  const cssFiles = await fg(`${SRC_DIR}/**/*.css`);

  const allFiles = [...jsFiles, ...cssFiles];

  if (allFiles.length === 0) {
    console.warn("No .js or .css files found in", SRC_DIR);
    return;
  }

  const toMinify = [];
  const toCopy = [];

  for (const file of allFiles) {
    if (isAlreadyMinified(file)) {
      toCopy.push(file);
    } else {
      toMinify.push(file);
    }
  }

  // Копируем уже минифицированные файлы как есть
  await Promise.all(toCopy.map(copyFile));

  // Собираем контексты для остальных
  const contexts = await Promise.all(
    toMinify.map((file) =>
      file.endsWith(".js") ? buildJsContext(file) : buildCssContext(file),
    ),
  );

  if (isWatch) {
    await Promise.all(contexts.map((ctx) => ctx.watch()));
    watchBootstrapContent();
    console.log(
      "Watching for changes... (already-minified files are copied once, not watched)",
    );
  } else {
    await Promise.all(contexts.map((ctx) => ctx.rebuild()));
    await Promise.all(contexts.map((ctx) => ctx.dispose()));
    console.log("Build complete.");
  }
}

function watchBootstrapContent() {
  const watcher = chokidar.watch(
    [path.resolve("**/*.php"), path.resolve(`${SRC_DIR}/**/*.{js,css}`)],
    {
      ignored: [
        path.resolve("node_modules/**"),
        path.resolve("vendor/**"),
        path.resolve(`${DIST_DIR}/**`),
      ],
      ignoreInitial: true,
    },
  );

  let timer;
  watcher.on("all", () => {
    clearTimeout(timer);
    timer = setTimeout(() => {
      BuildBootstrap().catch((err) =>
        console.error("Bootstrap rebuild failed:", err),
      );
    }, 150);
  });
}

function relativeOutDir(file) {
  const relative = path.relative(SRC_DIR, file);
  return path.join(DIST_DIR, path.dirname(relative));
}

function outPathMinified(file, ext) {
  const relative = path.relative(SRC_DIR, file);
  const dir = path.dirname(relative);
  const name = path.basename(relative, path.extname(relative));
  return path.join(DIST_DIR, dir, `${name}.min${ext}`);
}

async function copyFile(file) {
  const relative = path.relative(SRC_DIR, file);
  const dest = path.join(DIST_DIR, relative);
  await fs.mkdir(path.dirname(dest), { recursive: true });
  await fs.copyFile(file, dest);
  console.log(`Copied (already minified): ${relative}`);
}

async function buildJsContext(file) {
  return esbuild.context({
    entryPoints: [file],
    outfile: outPathMinified(file, ".js"),
    bundle: true,
    minify: true,
    format: "iife",
    target: ["es2018"],
    sourcemap: false,
    logLevel: "info",
  });
}

async function buildCssContext(file) {
  return esbuild.context({
    entryPoints: [file],
    outfile: outPathMinified(file, ".css"),
    bundle: true,
    minify: true,
    loader: { ".css": "css" },
    logLevel: "info",
  });
}

run().catch((err) => {
  console.error(err);
  process.exit(1);
});
