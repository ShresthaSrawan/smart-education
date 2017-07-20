<style>
	.comment-bar {
		border-top: 1px solid rgba(0,0,0,0.1);
		padding: 5px 0;
	}
</style>

<template>
	<div>
		<div class="comment-bar">
			<a href="#">Like</a>
			<a href="javascript:void(0);" @click="expanded = !expanded">Comment</a>
		</div>
		<div class="comments" v-if="expanded">
			<input type="text" placeholder="Comment" class="form-control">
		</div>
	</div>
</template>

<script>
	export default {
	    data() {
	        return {
	            expanded: false
			}
		}
	}
</script>