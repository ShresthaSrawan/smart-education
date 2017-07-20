require('./bootstrap');


window.Vue = require('vue');
Vue.component('Loader', require('./components/Loader'));
Vue.component('Notice', require('./components/Notice'));
Vue.component('PostList', require('./components/PostList'));
Vue.component('NewPost', require('./components/NewPost'));

Vue.use('infiniteScroll', require('vue-infinite-scroll'));

new Vue({
    el: '#app',
    data: {
        posts: []
    },
    events: {
        newPost(post) {
            this.posts = [post, ...this.posts];
        }
    }
});