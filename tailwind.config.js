import forms from '@tailwindcss/forms';

const colors = require('tailwindcss/colors')
const withMT = require("@material-tailwind/html/utils/withMT");

/** @type {import('tailwindcss').Config} */
export default withMT({
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                ...colors,
            }
        },
    },

    plugins: [forms, require('flowbite/plugin')],
});
