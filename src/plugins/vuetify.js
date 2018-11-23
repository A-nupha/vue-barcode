import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import colors from 'vuetify/es5/util/colors';

Vue.use(Vuetify, {
  theme: {
    primary: colors.lightBlue.accent4,
    primaryDark: colors.lightBlue.darken3,
    primaryLight: colors.blue.lighten1,
    success: colors.green.darken1,
    error: colors.red.darken1,
    warning: colors.yellow.darken4,
  //   secondary: '#424242',
  //   accent: '#82B1FF',
  //   error: '#FF5252',
  //   info: '#2196F3',
  //   success: '#4CAF50',
  //   warning: '#FFC107',
  },
  customProperties: true,
  iconfont: 'mdi',
})