import Vue from 'vue'
import Vuex from 'vuex'
import getApi from './modules/getApi'
import pathify from "vuex-pathify"
import { make } from "vuex-pathify"
pathify.options.mapping = "simple"

const staticState = {
  userName: null,
  passWord: null,
  dataSelect: [],
  dataScan: [],
  msgLogin: null,
  msgSuscessLogin: null,
  msgErrorLogin: null,
  msgSave: null,
  dataUserApi: [],
  dataUserApi2: [],
}
console.log(staticState)

// initial state
const state = Object.assign(staticState)
// console.log(staticState.msgLogin)

const mutations = make.mutations(state)
const resetMutation = {
  resetState(state) {
    Object.assign(state, getDefaultState());
    // state = {
    //   ...state,
    //   ...getDefaultState()
    // }
  },
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
    pathify.plugin,
  ],
  // store properties
  state,
  mutations,
  actions,
  getters,
})
