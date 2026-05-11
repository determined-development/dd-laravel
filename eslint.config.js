import js from "@eslint/js";
import globals from "globals";

export default [
    {
        ignores: ["vendor/**/*", "public/**/*"],
    },
    {
        files: ["resources/js/**/*.js"],
        ...js.configs.recommended,
        languageOptions: {
            globals: {
                ...globals.browser
            },
        },
    },
];
