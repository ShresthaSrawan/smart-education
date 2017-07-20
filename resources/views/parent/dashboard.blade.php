<div class="row" id="app">
    <div class="col-md-8">
        <new-post v-on:new_post="addPost"></new-post>
        <hr>
        <post-list :posts.sync="posts" :fetch_posts="fetch_posts"></post-list>
    </div>
    <div class="col-md-4">
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{ mix('js/dashboard.js') }}"></script>
@endpush