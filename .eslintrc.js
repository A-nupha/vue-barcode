module.exports = {
  root: true,
  env: {
    node: true
  },
  'extends': [
    'plugin:vue/essential',
    '@vue/airbnb'
  ],
  rules: {
    'no-console': process.env.NODE_ENV === 'production' ? 'error' : 'off',
    'no-debugger': process.env.NODE_ENV === 'production' ? 'error' : 'off',
    'import/no-extraneous-dependencies': 'off',
    'linebreak-style': 'off',
    'semi': 'off',
    'arrow-body-style': 'off',
    'func-names': 'off',
    'no-param-reassign': 'off'
  },
  parserOptions: {
    parser: 'babel-eslint'
  }
}