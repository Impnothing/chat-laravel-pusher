<template>
    <ul class="chat">
        <li class="left clearfix" v-for="tweet in tweets">
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font">
                        {{ tweet.user.name }}
                    </strong>
                </div>
                <p v-if="tweet">
                    {{ tweet.tweet }}
                </p>
            </div>
        </li>
    </ul>
</template>

<script>
  export default {
    props: ['tweets']
  };
</script>