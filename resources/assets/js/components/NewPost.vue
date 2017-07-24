<style>
	.thumbs {
		height: 70px;
		width: auto;
	}

	.thumbs-container {
		padding: 5px;
		height: 81px;
		background: rgba(0,0,0,0.05);
	}

	.thumb-wrap {
		position: relative;
		display: inline-block;
		height: 72px;
		width: 70px;
		background: rgba(0,0,0,0.1);
		border: 1px solid rgba(0,0,0,0.3);
	}

	.remove-thumb {
		position: absolute;
		right: -5px;
		top: -5px;
		color: black;
		z-index: 1;
		background: white;
		padding: 2px;
		border-radius: 10px;
		border: 1px solid rgba(0, 0, 0, 0.1);
	}

	.post-status {
		position: relative;
	}

	.loader {
		position: absolute;
		height: 100%;
		width: 100%;
		background: rgba(0, 0, 0, 0.05);
		z-index: 1;
	}

	.btn-add {
		padding: 24px 28px;
	}
</style>
<template>
	<div class="post-status">
		<div class="loader" v-if="busy">
			<loader></loader>
		</div>
		<form ref="postForm">
			<div class="form-group">
				<textarea v-model="message" placeholder="Post activity about children" class="form-control"></textarea>
				<multiselect
						v-if="showTags"
						v-model="tags"
						id="ajax"
						label="name"
						track-by="code"
						placeholder="Type to search"
						selectLabel="↲"
						deselectLabel="Remove"
						open-direction="bottom"
						:taggable="true"
						:options="options"
						:multiple="true"
						:searchable="true"
						:loading="isLoading"
						:internal-search="false"
						:clear-on-select="false"
						:close-on-select="false"
						:max-height="600"
						:show-no-results="false"
						@tag="addTag"
						@search-change="asyncFind">
					<template slot="clear" scope="props">
						<div class="multiselect__clear" v-if="tags.length"
							 @mousedown.prevent.stop="clearAll(props.search)"></div>
					</template>
					<span slot="noResult">Oops! No elements found. Consider changing the search query.</span>
				</multiselect>
			</div>
			<div class="form-group thumbs-container" v-if="showImage">
				<div class="thumb-wrap" v-for="(image, i) in images">
					<img :src="image" class="thumbs">
					<!--<i class="fa fa-close remove-thumb" @click="removeImage(i)"></i>-->
				</div>
				<input type="file" accept="image/*" id="images" @change="changeImage" multiple="multiple"
					   class="hidden">
				<div class="thumb-wrap">
					<label for="images" class="btn-add">
						<span>
							<i class="fa fa-image"></i>
						</span>
					</label>
				</div>
			</div>
			<div class="row">
				<div class="btn-group text-left col-sm-6">
					<button class="btn btn-default" :class="{'active' : showImage}" @click="showImage = !showImage"
							type="button"><i class="fa fa-image"></i></button>
					<button class="btn btn-default" :class="{'active' : showTags}" @click="showTags = !showTags"
							type="button"><i class="fa fa-tags"></i></button>
				</div>
				<div class="text-right col-sm-6">
					<button class="btn" type="button" @click="submitPost">Post <i class="fa fa-save"></i></button>
				</div>
			</div>
		</form>
	</div>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    import Loader from './Loader';

    export default {
        data() {
            return {
                message: '',
                images: [],
                rawImages: [],
                tags: [],
                options: [],
                isLoading: false,
                showTags: false,
                showImage: false,
                busy: false
            }
        },
        watch: {
            'rawImages': 'updateFormImageData'
        },
        methods: {
            formData() {
                let formData = new FormData();
                formData.set('message', this.message);
                this.tags.forEach((tag, i) => {
                    if (tag.type) {
                        formData.set('tags[' + i + '][tagable_id]', tag.id);
                        formData.set('tags[' + i + '][tagable_type]', tag.type);
                    } else {
                        formData.set('tags[' + i + '][name]', tag.name);
                    }
                });
                this.rawImages.forEach((image, i) => formData.append(`images[${i}]`, image));

                return formData;
            },
            changeImage(e) {
                this.rawImages = Array.from(e.target.files || e.dataTransfer.files);
            },
            updateFormImageData() {
                let p = this;
                p.busy = true;
                if (!p.rawImages.length)
                    return;
                p.images = [];
                p.rawImages.forEach(image => p.createImage(image));
                p.busy = false;
            },
            submitPost() {
                const p = this;
                p.busy = true;
                axios.post('post', this.formData())
                    .then(({data}) => {
                        p.$emit('new_post', data.post);
                        p.images = [];
                        p.message = "";
                        p.tags = [];
                        p.$refs.postForm.reset();
                        p.busy = false;
                        alert('posted');
                    })
                    .catch(err => {
                        console.log(err);
                        p.busy = false;
                    });
            },
            createImage(file) {
                let p = this;
                let reader = new FileReader();

                reader.onload = (e) => {
                    p.images.push(e.target.result);
                };
                reader.readAsDataURL(file);
            },
            removeImage(i) {
                let p = this;
                console.log(p.images, p.rawImages, i);
				p.images.splice(i, 1);
				p.rawImages.splice(i, 1);
            },
            asyncFind(query) {
                this.isLoading = true;
                axios.get('/api/tags/search', {
                    params: {
                        api_token: API_TOKEN,
                        query: query
                    }
                }).then(response => {
                    this.options = response.data;
                    this.isLoading = false;
                });
            },
            clearAll() {
                this.tags = [];
            },
            addTag(newTag) {
                const tag = {
                    name: newTag,
                    code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
                };
                this.options.push(tag);
                this.tags.push(tag);
            },
        },
        components: {
            Multiselect,
            Loader
        }
    }
</script>