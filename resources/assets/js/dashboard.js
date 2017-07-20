require('./bootstrap');


window.Vue = require('vue');
Vue.component('Loader', require('./components/Loader'));
Vue.component('Notice', require('./components/Notice'));
Vue.component('PostList', require('./components/PostList'));
Vue.component('NewPost', require('./components/NewPost'));

Vue.use('infiniteScroll', require('vue-infinite-scroll'));

const app = new Vue({
    el: '#app',
    data: {
        posts: []
    },
    mounted() {
    	this.fetch_posts();
    },
    methods: {
    	fetch_posts() {
            const p = this;
            p.busy = true;
            axios.get('/api/post/list',{
                params: {
                    api_token: API_TOKEN
                }
            })
                .then(({data}) => {
                    p.posts = [...p.posts, ...data.posts];
                    p.busy = false;
                })
                .catch(err => {
                    console.log(err);
                    p.busy = false;
                });
        },
        addPost(post) {
        	console.log('catching');
    		this.posts = [post, ...this.posts];
        }
    }
});