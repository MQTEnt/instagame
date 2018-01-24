var path = require('path');
// var webpack = require('webpack');
module.exports = {
  entry: './resources/assets/js/member/game/index.js',

  output: {
    filename: 'index.js',
    path: path.join('public/js/member/game')
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