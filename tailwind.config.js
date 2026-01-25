import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    50: '#f5f7ff',
                    100: '#ebf0ff',
                    200: '#d6e0ff',
                    300: '#b3c5ff',
                    400: '#8da3ff',
                    500: '#667eea',
                    600: '#5568d3',
                    700: '#4451b8',
                    800: '#343d94',
                    900: '#252d70',
                },
                secondary: {
                    50: '#faf5ff',
                    100: '#f3e8ff',
                    200: '#e9d5ff',
                    300: '#d8b4fe',
                    400: '#c084fc',
                    500: '#764ba2',
                    600: '#643d8a',
                    700: '#523172',
                    800: '#40245a',
                    900: '#2e1942',
                },
            },
            fontFamily: {
                sans: ['Inter', 'system-ui', 'sans-serif'],
                display: ['Poppins', 'system-ui', 'sans-serif'],
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}
