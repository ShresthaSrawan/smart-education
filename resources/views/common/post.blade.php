<form action="{{ route('post.store') }}">
    <div class="post-status">
        <div class="form-group">
            <textarea name="message" placeholder="Post activity about children" class="form-control"></textarea>
        </div>
        <div class="row">
            <div class="btn-group btn-group-sm text-left col-sm-6">
                <button class="btn"><i class="fa fa-paperclip"></i></button>
                <button class="btn"><i class="fa fa-image"></i></button>
            </div>
            <div class="text-right col-sm-6">
                <button class="btn" type="submit">Post <i class="fa fa-save"></i></button>
            </div>
        </div>
    </div>
</form>