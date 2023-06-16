/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "./src/templates/*.twig"
  ],
  theme: {
    extend: {
      colors: {
        'green-tea': '#BEEDAA',
        'dark-tea': '#113E06',
        'tea-green': '#D5FFD9',
        'error': '#f32d52'
      }
    },
  },
  plugins: [],
}

