import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php', // All Blade files in your Laravel project
        './resources/js/**/*.vue', // Include Vue files if using Vue.js
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['FigTree', ...defaultTheme.fontFamily.sans],
                inter: ['Inter', ...defaultTheme.fontFamily.sans],
                roboto: ['Roboto', 'sans-serif'], // Define Roboto as a fontFamily
            },
        },
    },
    plugins: [forms, typography],
};
