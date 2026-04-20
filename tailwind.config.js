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
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: '#c8f135',
                'brand-hover': '#d4f54e',
                dark: '#0a0a0a',
                surface: '#f8f7f4',
            },
            keyframes: {
                'fade-in-up': {
                    '0%': { opacity: '0', transform: 'translateY(16px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                'bounce-in': {
                    '0%': { opacity: '0', transform: 'scale(0) rotate(2deg)' },
                    '60%': { opacity: '1', transform: 'scale(1.1) rotate(2deg)' },
                    '100%': { opacity: '1', transform: 'scale(1) rotate(2deg)' },
                },
                ticker: {
                    '0%': { transform: 'translateX(0)' },
                    '100%': { transform: 'translateX(-50%)' },
                },
            },
            animation: {
                'fade-in-up': 'fade-in-up 0.5s ease-out both',
                'bounce-in': 'bounce-in 0.6s ease-out 1s both',
                ticker: 'ticker 28s linear infinite',
            },
        },
    },

    plugins: [forms],
};
