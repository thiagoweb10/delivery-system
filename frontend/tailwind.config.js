/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}"
  ],
  theme: {
    extend: {
      colors: {
        primary: "#1e3a8a",
        success: "#10b981",
        warning: "#f59e0b",
        error: "#ef4444",
        linkedin: '#f4f2ee', // cor de fundo LinkedIn f4f2ee
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif']
      }
    }
  },
  plugins: [
    function({ addBase, theme }) {
      addBase({
        'body': { backgroundColor: theme('colors.linkedin') } // corrigi aqui
      })
    }
  ],
}
