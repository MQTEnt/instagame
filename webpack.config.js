var path = require('path');
// var webpack = require('webpack');
module.exports = {
  entry: './resources/assets/js/admin/game/index.js',

  output: {
    filename: 'edit.js',
    path: path.join('public/js/admin/game')
  },

  module: {
    loaders: [
      {
        test: /\.js?$/,
        loader: 'babel-loader',
        query: {
          presets: ['react', 'es2015', 'stage-0']
        }
      },
      {
        test: /\.css$/,
        loader:'style!css!'
      }
    ]
  },
  watch: true
};