/** @type {import("prettier").Config} */
const config = {
    plugins: ["@prettier/plugin-php", "@shufo/prettier-plugin-blade", "prettier-plugin-tailwindcss"],
    printWidth: 100,
    tabWidth: 4,
    useTabs: false,
    semi: false,
    trailingComma: "es5",
    bracketSpacing: true,
    bracketSameLine: false,
    arrowParens: "always",
    endOfLine: "auto",
    phpVersion: "8.1",
    overrides: [
        {
          files: ["*.blade.php"],
          options: {
            parser: "blade",
            tabWidth: 4
          }
        }
      ]
}

module.exports = config
