<div class="row" id="app">
    <div class="col-md-8">
        @permission('create-post')
            @include('common.post')
        @endpermission
        <hr>
        <div v-infinite-scroll="fetchPosts" infinite-scroll-disabled="busy" infinite-scroll-distance="50" class="post-lists clearfix">
            <post v-for="post in posts" :key="post.id" :post="post"></post>
            <loader v-if="busy" />
        </div>
    </div>
    <div class="col-md-4">
        <notice></notice>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{ mix('js/dashboard.js') }}"></script>
@endpush