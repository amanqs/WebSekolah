import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Livewire/**/*.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', 'Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: 'var(--color-primary, #1e40af)',
                    50: 'var(--color-primary-50, #eff6ff)',
                    100: 'var(--color-primary-100, #dbeafe)',
                    500: 'var(--color-primary, #1e40af)',
                    600: 'var(--color-primary-dark, #1d4ed8)',
                    700: 'var(--color-primary-darker, #1e3a8a)',
                },
                secondary: {
                    DEFAULT: 'var(--color-secondary, #059669)',
                    50: '#ecfdf5',
                    500: 'var(--color-secondary, #059669)',
                    600: '#047857',
                },
                accent: {
                    DEFAULT: 'var(--color-accent, #f59e0b)',
                    50: '#fffbeb',
                    500: 'var(--color-accent, #f59e0b)',
                    600: '#d97706',
                },
            },
        },
    },

    plugins: [forms, typography],
};

