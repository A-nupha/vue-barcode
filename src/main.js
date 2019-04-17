import '@babel/polyfill'
import Vue from 'vue';
import './plugins/vuetify'
import App from './App.vue';
import router from './router';
import store from './store/store';
// eslint-disable-next-line import/order
import VueMoment from 'vue-moment';
// import moment from 'moment-timezone'
import 'chart.js'
import 'hchs-vue-charts'
import GlobalDate from './views/GlobalDate.vue'

Vue.use(window.VueCharts)
Vue.component(GlobalDate.name, GlobalDate);

Vue.config.productionTip = false;

new Vue({
  // moment,
  VueMoment,
  router,
  store,
  render: h => h(App),
}).$mount('#app');
