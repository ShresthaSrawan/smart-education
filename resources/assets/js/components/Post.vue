<template>
    <div class="post">
        <div class="post-heading">
            <div class="row">
                <div class="col-xs-2">
                    <img :src="post.user.thumbnail" class="img-circle img-responsive">
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
            <div class="post-thumbnail">
                <img :src="post.thumbnail" class="img-responsive">
            </div>
            <div class="post-detail">
                <p>
                    {{ post.message }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['post']
    }
</script>