/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./templates/**/*.php",
    "./template-parts/**/*.php",
    "./inc/**/*.php",
    "./blocks/**/*.php",
    "./assets/js/**/*.js"
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        primary: '#0e121b', // Main brand color for text/dark mode items based on your design
        background: {
          light: '#f9fafc', // Derived from original bg-gray-50
          dark: '#0e121b'
        },
        timber: {
          DEFAULT: '#8b5a2b',
          dark: '#1e2433' // Taken from footer bg-timber-dark
        }
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/aspect-ratio')
  ],
}
