const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'sea': {
                    '50': '#f9fbfb', 
                    '100': '#f3f7f7', 
                    '200': '#e1eaea', 
                    '300': '#cfdddd', 
                    '400': '#abc4c4', 
                    '500': '#87aaaa', 
                    '600': '#7a9999', 
                    '700': '#658080', 
                    '800': '#516666', 
                    '900': '#425353'
                }
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
