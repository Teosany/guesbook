/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.{html.twig,js,css}",
    "./templates/**/*.{html.twig,js,css}",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}
