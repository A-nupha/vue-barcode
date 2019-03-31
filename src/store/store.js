import Vue from 'vue'
import Vuex from 'vuex'
import pathify from "vuex-pathify"
import { make } from "vuex-pathify"
import getApi from './modules/getApi'

pathify.options.mapping = 'simple'

const getDefaultState = () => ({
  userName: null,
  passWord: null,
  dataSelect: [],
  dataScan: [],
  msgLogin: null,
  msgSuscessLogin: null,
  msgErrorLogin: null,
  msgSave: null,
  dataUserApi: [],
})
console.log(getDefaultState)

const state = Object.assign(getDefaultState())

const mutations = make.mutations(state)
const resetMutation = {
  resetState(state) {
    Object.assign(state, getDefaultState());
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
