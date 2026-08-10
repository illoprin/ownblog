import { defineConfig } from "vite";
import fg from "fast-glob";
import path from "node:path";
import { fileURLToPath } from "node:url";

const __dirname = path.dirname(fileURLToPath(import.meta.url));

const SRC_DIR = "assets/src";
const DIST_DIR = "assets/dist";

// Ищем все css и js файлы внутри assets/src
function getEntries() {
  const files = fg.sync(`${SRC_DIR}/**/*.{js,css}`, { absolute: false });

  const entries = {};

  for (const file of files) {
    // относительный путь без расширения — станет ключом (и именем в dist)
    const relativePath = path.relative(SRC_DIR, file);
    const entryName = relativePath.slice(0, -path.extname(relativePath).length);

    entries[entryName] = path.resolve(__dirname, file);
  }

  return entries;
}

export default defineConfig({
  build: {
    outDir: DIST_DIR,
    emptyOutDir: true,
    assetsDir: "", // чтобы css не улетал в подпапку assets/
    minify: "esbuild", // можно заменить на 'terser'
    cssMinify: true,
    rollupOptions: {
      input: getEntries(),
      output: {
        entryFileNames: "[name].min.js",
        chunkFileNames: "[name].min.js",
        assetFileNames: "[name].min[extname]",
        format: "iife", // каждый js-файл минифицируется как самостоятельный скрипт
      },
    },
  },
});
