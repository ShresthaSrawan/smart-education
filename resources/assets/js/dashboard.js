require('./bootstrap');


window.Vue = require('vue');
Vue.component('Loader', require('./components/Loader'));
Vue.component('Notice', require('./components/Notice'));
Vue.component('PostList', require('./components/PostList'));
Vue.component('NewPost', require('./components/NewPost'));
Vue.component('Date', require('./components/Date'));

Vue.use('infiniteScroll', require('vue-infinite-scroll'));

const app = new Vue({
    el: '#app',
    data: {
        posts: [],
        page_no: 0
    },
    mounted() {
    	this.fetch_posts();
    },
    methods: {
    	fetch_posts() {
            const p = this;
            p.busy = true;
            p.page_no = p.page_no + 1;
            axios.get('/api/post/list',{
                params: {
                    api_token: API_TOKEN,
                    page: p.page_no
                }
            })
                .then(({data}) => {
                    p.posts = [...p.posts, ...data.posts.data];
                    p.busy = false;
                })
                .catch(err => {
                    console.log(err);
                    p.busy = false;
                });
        },
        addPost(post) {
    		this.posts = [post, ...this.posts];
        }
    }
});