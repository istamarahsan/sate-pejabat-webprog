/** @type {import("prettier").Config} */
const config = {
    plugins: ["@prettier/plugin-php" , "prettier-plugin-tailwindcss"],
    printWidth: 100,
    tabWidth: 4,
    useTabs: false,
    semi: false,
    trailingComma: "es5",
    bracketSpacing: true,
    bracketSameLine: false,
    arrowParens: "always",
    endOfLine: "auto",
    phpVersion: "8.1"
}

module.exports = config
