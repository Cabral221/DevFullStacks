export const state = {
    token: ''
}

export const mutations = {
    CSRF_TOKEN(state, csrf) {
        state.token = csrf
    }
}
export default {
    state,
    mutations
}
