<template>
  <div style="position:relative;">
    <div id="preloader" v-if="loading">
        <i class="fa fa-refresh fa-spin"></i><div id="loader">Chargement des commentaires en cours ...</div>
    </div>
    <comment :comment="comment" :ip="ip" v-for="comment in comments" :key="comment.id" transition="fade-from-right"></comment>
    <comment-form :id="id" :type="type" v-if="this.$store.getters.reply == 0"></comment-form>
  </div>
</template>

<script>
import comment from "./comments/Comment.vue";
import CommentForm from './comments/Form';
import { getComments } from "../store/actions";

// global.store = store;

export default {
  data () {
    return {
      // ici les getters 
      comments : this.$store.getters.comments,
      loading: false,
      reply: this.$store.getters.reply,
      // comments
      transition: '',
    }
  },
  components: { comment, CommentForm },
  methods: {
    // ici les actions et toutes autres methodes
    getComments
  },
  props: {
    id: Number,
    type: String,
    ip: String,
    author: String,
    comment: String,
  },
  mounted () {
    var vm = this
    let onScroll = () => {
      if((this.$el.getBoundingClientRect().bottom - window.innerHeight) <= 0){
        vm.loading = true
        this.getComments(this.$store,this.id,this.type).then(() => {
          vm.loading = false
        });
        window.removeEventListener('scroll', onScroll)
      }
    }
    window.addEventListener('scroll', onScroll)
    // vm.loading = true
  }
};
</script>
