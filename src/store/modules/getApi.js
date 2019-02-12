const state = {
  login: false,
  SetDataMenuRequest: null,
  
}


const actions = {
  
  setDataLogin({ commit, state }, payload) {
    commit('SET_LOGIN', payload)
  },
  SetDataMenuRequest({ commit, state }, payload) {
    commit('SetData_MenuRequest', payload)
    console.log(state)
  },
}
const mutations = {
  SET_LOGIN(state, payload) {
    state.login = payload
  },
  SetData_MenuRequest(state, payload) {
    state.SetDataMenuRequest = payload
  },
}

export default {
  namespaced: true, // ใช้เวลาอ้างถึงแต่ละ module
  state,
  actions,
  mutations,
}
