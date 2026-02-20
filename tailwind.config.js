import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    50: "#faf5ff",
                    100: "#f3e8ff",
                    200: "#e9d5ff",
                    300: "#e9b4fe",
                    400: "#d56ffd",
                    500: "#dc39f9",
                    600: "#680187ea", // Mendekati ungu cerah di bagian bawah logo
                    700: "#c022ce", // Warna transisi tengah
                    800: "#9821a8", // Ungu padat (Solid Purple)
                    900: "#7e1c87", // Ungu gelap di bagian atas teks logo
                    950: "#510764", // Deep purple untuk kontras maksimal
                },
            },
        },
    },

    plugins: [forms],
};
