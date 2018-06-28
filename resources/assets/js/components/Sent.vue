<template>
    <div class="input-group">
        <input id="btn-input" type="text" name="tweet" class="form-control input-sm" placeholder="Escribe aquí..." v-model="newTweet" @keyup.enter="sendTweet">

        <span class="input-group-btn">
            <button class="btn color-3 text-white btn-sm" id="btn-chat" @click="sendTweet">
                Enviar tweet
            </button>
        </span>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        data() {
            return {
                newTweet: ''
            }
        },

        methods: {
            sendTweet() {
                this.$emit('tweetsent', {
                    user: this.user,
                    tweet: this.newTweet
                });

                this.newTweet = ''
            }
        }    
    }
</script>