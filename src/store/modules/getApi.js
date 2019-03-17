const state = {
  login: null,
  SetDataMenuRequest: null,

}
const actions = {
  setDataLogin({ commit, state }, payload) {
    commit('SET_LOGIN', payload)
    console.log('state in store', state)
  },
}
const mutations = {
  SET_LOGIN(state, payload) {
    state.login = payload
  },
}

export default {
  namespaced: true, // ใช้เวลาอ้างถึงแต่ละ module
  state,
  actions,
  mutations,
}
