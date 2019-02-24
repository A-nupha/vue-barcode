import Vue from 'vue';
import Vuex from 'vuex';
import getApi from './modules/getApi';
import pathify from "vuex-pathify";
pathify.options.mapping = "simple";
import { make } from "vuex-pathify";

const staticState = {
 userName: null,
 passWord: null,

}

// initial state
const state = Object.assign(staticState)

const mutations = make.mutations(state)
const resetMutation = {
  resetState(state) {
    Object.assign(state, getDefaultState());
  }
}
Object.assign(mutations, resetMutation);

const actions = make.actions(state)
const getters = make.getters(state);

// use store
Vue.use(Vuex)


// create store
export default new Vuex.Store({
  modules: {
    getApi,
  },
  // use the plugin
  plugins: [
    pathify.plugin
  ],
  // store properties
  state,
  mutations,
  actions,
  getters
})