<template>
    <div>
        <div id="comments-form" class="row wow">
            <div class="col-md-12">
                <div class="mt60 mb50 single-section-title">
                    <h3>{{ reply == 0 ? 'Commenter' : 'Répondre' }}</h3>
                </div>
                <div id="comment_message"></div>
                    <span class="help-block danger">{{ errors }}</span>
                <form method="post" id="commentform" class="comment-form" @submit.prevent="sendComment">
                    <input type="text" class="'form-control col-md-4 ' + { error: errors.username }" v-model="username" placeholder="Nom d'utilisateur *" id="name1" required data-validation-error-msg="Please enter your name." />
                    <!-- <span class="help-block danger" v-if="errors.username">{{ errors.username.join(', ') }}</span>
                    <p v-else></p> -->
                    <input type="text" class="'form-control col-md-4 ' + { error: errors.email }" v-model="email" placeholder="Votre Email *" id="email1" required data-validation-error-msg="Please enter your email address." />
                    <!-- <span class="help-block danger" v-if="errors.email">{{ errors.email.join(', ') }}</span>
                    <p v-else> loading.....</p> -->
                    <textarea v-model="content" class="'form-control ' + { error: errors.content }" id="comments1" placeholder="Votre commentaire *" required data-validation-error-msg="Please enter a message."></textarea>
                    <!-- <span class="help-block danger" v-if="errors.content">{{ errors.content.join(', ') }}</span>
                    <p v-else> loading.....</p> -->
                    <button type="submit" class="btn btn-primary pull-right">{{ reply == 0 ? 'Commenter' : 'Répondre' }}</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { addComment } from '../../store/actions'

export default {
    data(){
        return {
            errors: {},
            username: '',
            email: '',
            content: '',
            loading: true,
        }
    },
    methods: {
        addComment,
        sendComment: function () {
            // this.errors = {}
            var vm = this;

            vm.loading = true
            // this.addComment(this.$store,{
            //     commentable_id: this.id,
            //     commentable_type: this.type,
            //     content: this.content,
            //     username: this.username,
            //     email: this.email,
            //     reply: this.reply
            // }).then(function (response) {
                
            //     console.log(response.data)
            //     // console.log(this.errors)

            //     vm.errors = response.data
            //     // this.errors = response.error

            //     // console.log(vm.errors)
            //     // console.log(response.data)
            // }).catch(function (error) {
            //     console.log(error)
            //     vm.loading = false
            // })
        }
    },
    props: {
        id: Number,
        type: String,
        reply: {
            type: Number,
            default: 0
        }
    }
}
</script>

