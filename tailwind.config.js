import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
<<<<<<< Updated upstream
import withMT from '@material-tailwind/html/utils/withMT';
=======
const colors = require('tailwindcss/colors')

const withMT = require("@material-tailwind/html/utils/withMT");
>>>>>>> Stashed changes

/** @type {import('tailwindcss').Config} */
export default withMT({
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/views/layouts/*.blade.php'
    ],

    theme: {
        extend: {
<<<<<<< Updated upstream
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
=======
            colors: {
                ...colors,
            }
        },
        fontFamily: {
            
>>>>>>> Stashed changes
        },
    },

    plugins: [forms],
});
