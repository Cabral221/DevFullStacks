<template>
  <div>
    <div id="preloader" v-if="loading">
      <i class="fa fa-refresh fa-spin"></i><div id="loader">Chargement des commentaires en cours ...</div>
    </div>
    <comment :comment="comment" :ip="ip" v-for="comment in comments" :key="comment.id"></comment>
    <comment-form :id="id" :type="type"></comment-form>
  </div>
</template>

<script>
import comment from "./comments/Comment.vue";
// import { Script } from 'vm';
import CommentForm from './comments/Form';
// import commentForm from './comments/Form';
// import store from '../store/store';
// import { comments } from "../store/getters";
import { getComments } from "../store/actions";

// global.store = store;

export default {
  // vuex: {
  //   getters: {
  //     comments,
  //   },
  //   actions: {
  //     addComments: function (store, comments) {
  //       store.commit('ADD_COMMENTS', comments)
  //     }
  //   }
  // },
  methods: {
    // ici les actions et toutes autres methodes
    getComments
  },
  data () {
    return {
      // ici les getters 
      comments : this.$store.getters.comments,
      loading: true,
      // comments
    }
  },
  components: { comment, CommentForm },
  props: {
    id: Number,
    type: String,
    ip: String,
    author: String,
    comment: String
  },
  mounted () {
    this.getComments(this.$store,this.id,this.type).then(() => {
      this.loading = false
    });
  }
};
</script>
