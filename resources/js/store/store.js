import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const state = {
    comments: [],
    reply: 0
}

export const mutations = {
    ADD_COMMENTS (state, comments) {
        state.comments.push(...comments)
    },
    ADD_COMMENT (state, comment) {
        if(comment.reply){
            let c = state.comments.find((c) => c.id === comment.reply)
            if(c.replies === undefined){
                c.replies = []
            }
            c.replies.push(comment)
        }else{
            state.comments.push(comment)
        }
    },
    DELETE_COMMENT (state, comment) {
        if(comment.reply){
            let parent = state.comments.find((c) => c.id === comment.reply)
            let index = parent.findIndex((c) => c.id === comment.id)
            parent.replies.splice(index, 1)
        }else{
            let index = state.comments.findIndex((c) => c.id === comment.id)
            state.comments.splice(index, 1)
        }
    },
    REPLY_TO (state, id) {
        state.reply = id
    },
}

export default new Vuex.Store({
    state,
    mutations
})
