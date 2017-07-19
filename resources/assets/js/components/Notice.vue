<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<template>
    <div class="panel panel-default">
        <div class="panel-heading">Quick Notice</div>
        <div class="panel-body">
            <div class="form-group">
                <input type="text" v-model="notice.title" class="form-control" placeholder="title">
            </div>
            <div class="form-group">
                <multiselect
                    v-model="notice.to"
                    id="ajax"
                    label="name"
                    track-by="code"
                    placeholder="Type to search"
                    open-direction="bottom"
                    :options="options"
                    :multiple="true"
                    :searchable="true"
                    :loading="isLoading"
                    :internal-search="false"
                    :clear-on-select="false"
                    :close-on-select="false"
                    :options-limit="300"
                    :limit="3"
                    :limit-text="limitText"
                    :max-height="600"
                    :show-no-results="false"
                    @search-change="asyncFind">
                    <template slot="clear" scope="props">
                        <div class="multiselect__clear" v-if="notice.to.length" @mousedown.prevent.stop="clearAll(props.search)"></div>
                    </template>
                    <span slot="noResult">Oops! No elements found. Consider changing the search query.</span>
                </multiselect>
            </div>
            <div class="form-group">
                <textarea v-model="notice.message" class="form-control" placeholder="Message"></textarea>
            </div>
        </div>
        <div class="panel-footer">
            <button class="btn btn-primary" @click="notify">Notify!</button>
        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    
    export default {
        data() {
            return {
                notice: {
                    title: '',
                    to: [],
                    message: ''
                },
                options: [],
                isLoading: false
            }
        },
        methods: {
            notify() {
                axios.post('/notice', this.notice)
                    .then(response => console.log(response));
            },
            asyncFind (query) {
              this.isLoading = true;
              axios.get('/api/user/search',{
                params: {
                    api_token: API_TOKEN,
                    query: query
                }
              }).then(response => {
                this.options = response.data;
                this.isLoading = false;
              });
            },
            clearAll () {
              this.notice.to = [];
            },
            limitText (count) {
              return `and ${count} other countries`;
            },
        },
        components: {
            Multiselect
        }
    }
</script>