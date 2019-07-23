import axios from 'axios'

export const getComments = function (store,id,type) {
    return axios.get("/comments", {
        params: {
            id: id,
            type: type
        }
    }).then(response => {
        store.commit('ADD_COMMENTS', response.data)
        // store.dispatch('addComments', response.data)
    }).catch(function (error) {
        console.log(error)
    })
} 

export const addComment = function (store,comment) {
    return axios.post("/comments",comment).then(response => {
        store.commit('ADD_COMMENT',response.data)
    })
}
