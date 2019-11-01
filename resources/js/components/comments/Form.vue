<template>
    <div>
        <div id="comments-form" class="row wow">
            <div class="col-md-12">
                <div class="mt60 mb50 single-section-title">
                    <h3>{{ reply == 0 ? 'Commenter' : 'Répondre' }}</h3>
                </div>
                <div id="comment_message">
                    <span class="help-block alert alert-danger" v-if="errors.username">{{ errors.username.join(', ') }}</span>
                    <span class="help-block alert alert-danger" v-if="errors.email">{{ errors.email.join(', ') }}</span>
                    <span class="help-block alert alert-danger" v-if="errors.content">{{ errors.content.join(', ') }}</span>
                </div>
                    <span class="help-block danger">{{ loading }}</span>
                <form method="post" id="commentform" class="comment-form" @submit.prevent="sendComment">
                    <input type="text" :class="'form-control col-md-4 '" v-model="username" placeholder="Nom d'utilisateur *" id="name1" required data-validation-error-msg="Please enter your name." />
                    <input type="text" :class="'form-control col-md-4 '" v-model="email" placeholder="Votre Email *" id="email1" required data-validation-error-msg="Please enter your email address." />
                    <textarea v-model="content" :class="'form-control '" id="comments1" placeholder="Votre commentaire *" required data-validation-error-msg="Please enter a message."></textarea>
                    <button type="submit" class="btn btn-primary pull-right">{{ reply == 0 ? 'Commenter' : 'Répondre' }}</button>
                    <button type="button" class="btn btn-primary pull-left" style="color:red" @click.prevent="cancel()" v-if=" reply > 0"> Annuler</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { addComment, replyTo } from '../../store/actions'

export default {
    data(){
        return {
            errors: {},
            username: '',
            email: '',
            content: '',
            loading: false,
        }
    },
    props: {
        id: Number,
        type: String,
        reply: {
            type: Number,
            default: 0
        },
    },
    methods: {
        addComment,
        replyTo,
        cancel: function () {
            this.replyTo(this.$store,0)
        },
        sendComment: function () {
            // this.errors = {}
            var vm = this;
            vm.errors = {}
            vm.loading = true
            this.addComment(this.$store,{
                commentable_id: this.id,
                commentable_type: this.type,
                content: this.content,
                username: this.username,
                email: this.email,
                reply: this.reply
            }).catch((error) => {
                // console.log(error.response.data)
                vm.errors = error.response.data
                // console.log(error.response.data)
            }).then(() => {
                // console.log("success")
                vm.loading = false
                if(Object.keys(vm.errors).length === 0) {
                    vm.username = ''
                    vm.email = ''
                    vm.content = ''
                }
            })
        }
    }
}
</script>

