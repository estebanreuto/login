import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: "#2563EB", // Azul pro
                    dark: "#1E40AF",
                    light: "#60A5FA",
                },
                accent: "#10B981", // Verde éxito
            },
        },
    },


    plugins: [forms],
};

