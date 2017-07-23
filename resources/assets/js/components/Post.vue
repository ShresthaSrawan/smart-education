<style>
    .post {
        border: 1px solid rgba(0,0,0,0.1);
        margin: 15px 0px;
        padding: 20px;
    }
</style>
<template>
    <div class="post">
        <div class="post-heading">
            <div class="row">
                <div class="col-xs-2">
                    <img v-if="post.user.image" :src="post.user.thumbnail" class="img-circle img-responsive">
                    <avatar v-else :username="post.user.first_name+' '+post.user.last_name"></avatar>
                </div>
                <div class="col-xs-10">
                    <div class="row">
                        <div class="col-xs-12">
                            {{ post.user.name }}
                        </div>
                        <div class="col-xs-12">
                            {{ post.created_at_formatted }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="post-body">
            <div class="post-thumbnail" v-if="post.images.length">
                <img :src="post.thumbnail" class="img-responsive">
            </div>
            <div class="post-detail">
                <p>
                    {{ post.message }}
                </p>
            </div>
            <div class="post-tags" v-if="post.tags.length">
                <ul>
                    <li v-for="tag in post.tags">
                        <a :href="'tag/'+tag.tagable.slug">{{ tag.tagable.name }}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="post-footer">
            <comment-list></comment-list>
        </div>
    </div>
</template>

<script>
    import CommentList from './CommentList.vue';
    import Avatar from 'vue-avatar/dist/Avatar';

    export default {
        props: ['post'],
        components: {
            CommentList,
            Avatar
        }
    }
</script>