/** @type {import('tailwindcss').Config} */

const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: ["./resources/**/*.blade.php", "./resources/**/*.js"],
    safelist: [
        {
            pattern: /p-indent-(0|1|2|3|4|5|6|7|8|9|10)/,
            variants: ["sm", "md", "lg"],
        },
    ],
    theme: {
        extend: {
            screens: {
                smArticles: "702px",
                mdArticles: "810px",
            },
            fontFamily: {
                sans: ["Sora", ...defaultTheme.fontFamily.sans],
                serif: ["Cormorant Garamond", ...defaultTheme.fontFamily.serif],
            },
            colors: {
                textBase: "rgb(3, 25, 33)",
                dBlue: "rgb(9, 118, 158)",
                primaryBlue: "rgb(15, 184, 249)",
                paleRose: "rgb(252, 247, 247)",
            },
            width: {
                logo: "320px",
                logoMedium: "341px",
                logoLarge: "521px",
            },
            padding: {
                "indent-0": "0rem",
                "indent-1": "0 0 0 2rem",
                "indent-2": "0 0 0 4rem",
                "indent-3": "0 0 0 6rem",
                "indent-4": "0 0 0 8rem",
                "indent-5": "0 0 0 10rem",
                "indent-6": "0 0 0 12rem",
                "indent-7": "0 0 0 14rem",
                "indent-8": "0 0 0 16rem",
                "indent-9": "0 0 0 18rem",
                "indent-10": "0 0 0 20rem",
            },
            gridTemplateColumns: {
                "3cards": "repeat(auto-fill, minmax(min(230px, 100%), 1fr))",
                "2cards": "repeat(auto-fill, minmax(min(350px, 100%), 1fr))",
                "2cardsLg": "repeat(auto-fill, minmax(min(300px, 100%), 1fr))",
                "3cardsFull":
                    "repeat(auto-fill, minmax(min(100%, 100%), 1fr)))",
            },
            keyframes: {
                "open-editor": {
                    "0%": { transform: "scaleY(0)" },
                    "100%": { transform: "scaleY(1)" },
                },
                "close-editor": {
                    "100%": { transform: "scaleY(0)" },
                    "0%": { transform: "scaleY(1)" },
                },
            },
            animation: {
                "open-editor": "open-editor 0.35s ease-in-out forwards",
                "close-editor": "close-editor 0.35s ease-in-out backwards",
            },
        },
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
