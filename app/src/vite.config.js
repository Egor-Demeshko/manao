// vite.config.js
import { defineConfig } from "vite";

export default defineConfig({
    build: {
        minify: false,
        rollupOptions: {
            input: {
                main: "main.html",
                loginForm: "loginForm.html",
            },
            output: {
                format: "es",
                entryFileNames: "[name].js",
                chunkFileNames: "[name].js",
                assetFileNames: "[name].[ext]",
            },
        },
    },
});
