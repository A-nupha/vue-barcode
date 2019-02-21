module.exports = {
  devServer: {
    // disableHostCheck: true,
    proxy: {
      '/api': {
        target: 'http://a-nuphasupit58.000webhostapp.com/',
        secure: true,
        changeOrigin: true,
        pathRewrite: {
          '^/api': '/',

        },
      },
    },
  },
}
