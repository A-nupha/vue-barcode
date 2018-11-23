const state = {
  login: false,
}


const actions = {
  setDataLogin({ commit, state }, payload) {
    commit('SET_LOGIN', payload)
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
