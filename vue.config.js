module.exports = {
    devServer: {
      // disableHostCheck: true,
      proxy: {
        '/api': {
          target: 'https://a-nuphasupit58.000webhostapp.com',
          secure: true,
          changeOrigin: true,
        },
      },
    },
  }