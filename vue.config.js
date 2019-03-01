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

  pwa: {
    name: 'Inventory Control',
    themeColor: '#2196F3',
    msTileColor: '#1976D2',
  },
}
