import Vue from 'vue';
import Vuex from 'vuex';
import getApi from './modules/getApi'

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production'
export default new Vuex.Store({
  modules: {
    getApi,
  },
  strict: debug,
})
