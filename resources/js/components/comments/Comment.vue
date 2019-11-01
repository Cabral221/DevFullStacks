<template>
    <div class="media" style="position:relative;">
        <div id="preloader" v-if="loading">
            <i class="fa fa-refresh fa-spin"></i><div id="loader">Chargement des commentaires en cours ...</div>
        </div>
        <div class="pull-left">
            <img class="avatar comment-avatar" src="/user/assets/img/users/1.jpg" alt="">
        </div>
        <div class="media-body">
            <div class="well">
                <div class="media-heading">
                    <span class="heading-font">{{ comment.username }}</span>&nbsp; <small class="secondary-font">{{ comment.created_at }} 
                        <span style="color:red" @click="deleteComment" v-if="can_delete"> Supprimer</span></small>
                </div>
                <p>{{ comment.content }}</p>
                <a class="btn btn-primary pull-right" href="#" @click.prevent="showreply(reply_to)"> Repondre</a>
            </div>
            <comment :comment="reply" :ip="ip" v-for="reply in comment.replies" :key="reply.id"></comment>
            <comment-form :id="comment.commentable_id" :type="comment.commentable_type" :reply="comment.id" v-if="form_visible"></comment-form>
        </div>
    </div>
</template>

<script>
import commentForm from './Form';
import { replyTo , deleteComment as deleteCommentAction } from '../../store/actions'
// import { reply } from '../../store/getters'

export default {
    name: 'comment',
    components: { commentForm },
    data () {
        return {
            loading: false,
        }
    },
    computed: {
        reply_to: function (){
            return this.comment.reply == 0 ? this.comment.id : this.comment.reply
        },
        form_visible: function () {
            return this.$store.getters.reply == this.comment.id
        },
        can_delete: function () {
            return this.ip == this.comment.ip_md5
        },
    },
    props: {
        ip: String,
        comment: Object,
    },
    methods: {
        replyTo,
        deleteCommentAction,
        showreply: function (id) {
            this.replyTo(this.$store,id)
        },
        deleteComment: function () {
            var vm = this;
            vm.loading = true
            this.deleteCommentAction(this.$store, this.comment).catch((error) => {
                window.alert(error.response.data)
            }).then(() => {
                vm.loading = false
            })
        }
    }
}
</script>
