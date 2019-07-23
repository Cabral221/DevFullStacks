<template>
    <div>
        <div id="comments-form" class="row wow">
            <div class="col-md-12">
                <div class="mt60 mb50 single-section-title">
                    <h3>{{ reply == 0 ? 'Commenter' : 'Répondre' }}</h3>
                </div>
                <div id="comment_message"></div>
                <form method="post" id="commentform" class="comment-form">
                    <input type="text" class="form-control col-md-4" v-model="username" placeholder="Your Name *" id="name1" required data-validation-required-message="Please enter your name." />
                    <input type="text" class="form-control col-md-4" v-model="email" placeholder="Your Email *" id="email1" required data-validation-required-message="Please enter your email address." />
                    <textarea v-model="content" class="form-control" id="comments1" placeholder="Your Message *" required data-validation-required-message="Please enter a message."></textarea>
                    <a class="btn btn-primary pull-right" href="#">{{ reply == 0 ? 'Commenter' : 'Répondre' }}</a>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            username: '',
            email: '',
            content: '',
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

