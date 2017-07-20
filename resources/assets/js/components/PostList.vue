<template>
	<div v-infinite-scroll="fetchPosts" infinite-scroll-disabled="busy" infinite-scroll-distance="50" class="post-lists clearfix">
		<post v-for="post in posts" :key="post.id" :post="post"></post>
		<loader v-if="busy"></loader>
	</div>
</template>

<script>
    window.Vue = require('vue');
    import Post from './Post';

	export default {
	    props: ['posts'],
	    data() {
	        return {
                busy: false
			}
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
            },
		},
		components: {
	        Post
		}
	}
</script>