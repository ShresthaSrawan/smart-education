<template>
	<div v-infinite-scroll="fetch_posts" infinite-scroll-disabled="busy" infinite-scroll-distance="50" class="post-lists clearfix">
		<post v-for="post in posts" :key="post.id" :post="post"></post>
		<loader v-if="busy"></loader>
		<div v-if="!posts.length">
			No Posts.
		</div>
	</div>
</template>

<script>
    import Post from './Post';

	export default {
	    props: ['posts', 'fetch_posts'],
	    data() {
	        return {
                busy: false
			}
		},
		components: {
	        Post
		}
	}
</script>