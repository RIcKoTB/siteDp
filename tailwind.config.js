/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './resources/**/*.ts',
    ],
    theme: {
        extend: {
            keyframes: {
                'fade-in-down': {
                    '0%': { opacity: 0, transform: 'translateY(-20px)' },
                    '100%': { opacity: 1, transform: 'translateY(0)' },
                },
                'fade-in-up': {
                    '0%': { opacity: 0, transform: 'translateY(20px)' },
                    '100%': { opacity: 1, transform: 'translateY(0)' },
                },
            },
            animation: {
                'fade-in-down': 'fade-in-down 0.6s ease-out',
                'fade-in-up': 'fade-in-up 0.6s ease-out',
            },
        },
    },
    plugins: [],
}
