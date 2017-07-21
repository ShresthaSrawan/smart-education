<style>
	.thumbs {
		height: 70px;
		width: auto;
	}
	.thumb-wrap {
		position: relative;
		display: inline-block;
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
		border: 1px solid rgba(0,0,0,0.1);
	}
</style>
<template>
	<div class="post-status">
		<form ref="postForm">
			<div class="form-group">
				<textarea v-model="message" placeholder="Post activity about children" class="form-control"></textarea>
			</div>
			<div class="form-group">
				<div class="thumb-wrap" v-for="image in images">
					<img :src="image" class="thumbs">
					<i class="fa fa-close remove-thumb" @click="removeImage(image)"></i>
				</div>
			</div>
			<div class="row">
				<div class="btn-group text-left col-sm-6">
					<input type="file" id="images" @change="changeImage" multiple="multiple"
						   class="hidden" ref="inputImages">
					<label for="images" class="btn"><i class="fa fa-image"></i></label>
				</div>
				<div class="text-right col-sm-6">
					<button class="btn" type="button" @click="submitPost">Post <i class="fa fa-save"></i></button>
				</div>
			</div>
		</form>
	</div>
</template>

<script>
    export default {
        data() {
            return {
				message: '',
				images: [],
                rawImages: [],
				formData: null
            }
        },
		watch: {
            'message': 'updateFormMessageData',
			'rawImages': 'updateFormImageData'
		},
		mounted() {
            this.formData = new FormData();
		},
        methods: {
            changeImage(e) {
                this.rawImages = e.target.files || e.dataTransfer.files;
			},
            updateFormMessageData() {
                this.formData.set('message', this.message);
            },
            updateFormImageData() {
                if (!this.rawImages.length)
                    return;
                this.images = [];

                for (let k = 0; k < this.rawImages.length; k++) {
                    this.formData.append(`images[${k}]`, this.rawImages[k]);
                    this.createImage(this.rawImages[k])
                }
			},
            submitPost() {
                const p = this;

                axios.post('post', this.formData)
                    .then(({data}) => {
                        p.$emit('new_post', data.post);
                        p.images = [];
                        p.message = "";
                        p.$refs.postForm.reset();
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
            removeImage(image) {
                let p = this;
                let i = p.images.indexOf(image);
                if(i != -1) {
                    p.images.splice(i, 1);
                }
            }
        }
    }
</script>