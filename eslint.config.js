import js from "@eslint/js";
import globals from "globals";

import {defineConfig, globalIgnores} from "eslint/config";

export default defineConfig([
    globalIgnores(["node_modules/**", "vendor/**", "public/**", "storage/**"]),
    {
        files: ["resources/js/**/*.js"],
        plugins: {js},
        languageOptions: {
            globals: globals.browser
        },
    },
]);
