const theme = require('./tailwind-theme/index')

module.exports = {
  purge: [
    './src/components/**/*.{js,ts,jsx,tsx}',
    './src/pages/**/*.{js,ts,jsx,tsx}',
    './src/sass/*.sass',
  ],
  theme,
  variants: {},
  plugins: [],
}
