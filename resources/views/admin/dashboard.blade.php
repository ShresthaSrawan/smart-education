<div class="row" id="app">
    <div class="col-md-8">
        <new-post></new-post>
        <hr>
        <post-list :posts.sync="posts"></post-list>
    </div>
    <div class="col-md-4">
        <notice></notice>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{ mix('js/dashboard.js') }}"></script>
@endpush