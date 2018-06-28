
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('chat-tweets', require('./components/Tweet.vue'));
Vue.component('chat-form', require('./components/Sent.vue'));
const URL= '{{url('/')}}'
const app = new Vue({
    el: '#app',
	
    data: {
        tweets: []
    },
	created() {
        this.showTweets();
		Echo.private('chat')
			.listen('TweetSentEvent', (e) => {
			this.tweets.push({
				tweet: e.tweet.tweet,
				user: e.user
    });
  });
    },
    methods: {
        showTweets() {
            axios.get('tweets').then(response => {
                this.tweets = response.data;
            });
        },
         addTweet(tweet) {
            this.tweets.push(tweet);

            axios.post('tweets', tweet).then(response => {
              console.log(response.data);
            });
        }
    }
});
