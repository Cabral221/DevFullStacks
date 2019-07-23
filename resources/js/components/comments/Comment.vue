<template>
    <div class="media">
        <div class="pull-left">
            <img class="avatar comment-avatar" src="/user/assets/img/users/1.jpg" alt="">
        </div>
        <div class="media-body">
            <div class="well">
                <div class="media-heading">
                    <span class="heading-font">{{ comment.username }}</span>&nbsp; <small class="secondary-font">{{ comment.created_at }}</small>
                </div>
                <p>{{ comment.content }}</p>
                <a class="btn btn-primary pull-right" href="#">Repondre</a>
            </div>
            <comment :comment="reply" :ip="ip" v-for="reply in comment.replies" :key="reply.id"></comment>
            <!-- <comment-form :id="comment.commentable_id" :type="comment.commentable_type" :reply="comment.id" v-if="comment.reply == 0"></comment-form> -->
        </div>
    </div>
</template>

<script>
import commentForm from './Form';

export default {
    name: 'comment',
    components: { commentForm },
    props: {
        ip: String,
        comment: Object,
    }
}
</script>
