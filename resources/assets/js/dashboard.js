require('./bootstrap');


window.Vue = require('vue');

Vue.component('Post', require('./components/Post.vue'));
Vue.component('Loader', require('./components/Loader.vue'));
Vue.component('Notice', require('./components/Notice.vue'));
Vue.use('infiniteScroll', require('vue-infinite-scroll'));

new Vue({
    el: '#app',
    data: {
        posts: [],
        busy: false
    },
    mounted() {
        this.fetchPosts()
    },
    methods: {
        fetchPosts() {
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
        }
    }
});