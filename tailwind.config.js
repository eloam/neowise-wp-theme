module.exports = {
  purge: {
    enabled: false,
    content : [
      './components/**/*.twig',
      '*.php'
    ]
  },
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [require('@tailwindcss/typography')],
}
