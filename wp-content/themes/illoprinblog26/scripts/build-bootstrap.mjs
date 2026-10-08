import esbuild from "esbuild";
import fg from "fast-glob";
import fs from "node:fs/promises";
import path from "node:path";
import { fileURLToPath } from "node:url";
import { PurgeCSS } from "purgecss";
import * as sass from "sass";

const SCRIPT_DIR = path.dirname(fileURLToPath(import.meta.url));
const THEME_DIR = path.resolve(SCRIPT_DIR, "..");
const BOOTSTRAP_ENTRY = path.join(
  THEME_DIR,
  "node_modules/bootstrap/scss/bootstrap.scss",
);
const OUTPUT_FILE = path.join(THEME_DIR, "assets/dist/css/bootstrap.min.css");

const safelist = [
  "show",
  "showing",
  "hiding",
  "fade",
  "collapsing",
  "collapse-horizontal",
  "modal-backdrop",
  "modal-static",
  "modal-open",
  "offcanvas-backdrop",
  "tooltip",
  "tooltip-arrow",
  "tooltip-inner",
  "popover",
  "popover-arrow",
  "popover-header",
  "popover-body",
  "was-validated",
  "is-valid",
  "is-invalid",
];

export async function BuildBootstrap() {
  const compiled = sass.compile(BOOTSTRAP_ENTRY, {
    style: "compressed",
    quietDeps: true,
    silenceDeprecations: [
      "import",
      "if-function",
      "global-builtin",
      "color-functions",
    ],
  });

  const content = await fg(["**/*.php", "assets/src/**/*.{js,css}"], {
    cwd: THEME_DIR,
    absolute: true,
    ignore: ["node_modules/**", "vendor/**", "assets/dist/**"],
  });

  const purgeCss = new PurgeCSS();
  const [purged] = await purgeCss.purge({
    content,
    css: [{ raw: compiled.css, name: "bootstrap.scss" }],
    safelist: { standard: safelist },
    dynamicAttributes: ["data-bs-popper", "data-bs-theme"],
  });

  const minified = await esbuild.transform(purged.css, {
    loader: "css",
    minify: true,
  });

  await fs.mkdir(path.dirname(OUTPUT_FILE), { recursive: true });
  await fs.writeFile(OUTPUT_FILE, minified.code);

  console.log(
    `Built Bootstrap: ${path.relative(THEME_DIR, OUTPUT_FILE)} (${content.length} content files)`,
  );
}
