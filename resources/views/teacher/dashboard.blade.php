<div class="row" id="app">
    <div class="col-md-2">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-stacked">
                    <li><a href="{{ route('parent.index') }}">Parent Users</a></li>
                </ul>
            </div>
        </div>
        <date></date>
    </div>
    <div class="col-md-10">
        <div class="row" id="app">
            <div class="col-md-8">
                <new-post v-on:new_post="addPost"></new-post>
                <hr>
                <post-list :posts.sync="posts" :fetch_posts="fetch_posts"></post-list>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{ mix('js/dashboard.js') }}"></script>
@endpush