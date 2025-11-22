/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: '#E53935',
                darkred: '#B71C1C',
                lightred: '#FFEBEE',
                bg: '#FAFAFA',
                card: '#FFFFFF',
                tech: '#F5F5F7'
            },
            fontFamily: {
                sans: ['Inter', 'system-ui', 'sans-serif'],
            },
            boxShadow: {
                tech: '0 4px 14px 0 rgba(0, 0, 0, 0.08)',
                'tech-lg': '0 10px 28px rgba(0, 0, 0, 0.08)',
                glow: '0 0 20px rgba(229, 57, 53, 0.15)'
            }
        },
    },
    plugins: [],
};
