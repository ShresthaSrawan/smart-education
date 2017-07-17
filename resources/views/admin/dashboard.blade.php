<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="nav nav-stacked">
                        <li><a href="{{ route('admin.index') }}">Admin Users</a></li>
                        <li><a href="{{ route('teacher.index') }}">Teacher Users</a></li>
                        <li><a href="{{ route('parent.index') }}">Parent Users</a></li>
                    </ul>
                </div>
            </div>
            <div class="panel panel-default">
                <h2>{{ date('d') }}</h2>
                <h3>{{ date('M') }}</h3>
            </div>
        </div>
        <div class="col-md-6">
            @include('common.post')
            <hr>
            <div class="post-lists clearfix">
                @component('components.post')
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas voluptatem eaque, voluptatum vitae eveniet debitis consequatur rem a voluptate. Quisquam numquam fuga delectus, quos iste earum aliquam hic ad dolore.
                @endcomponent
            </div>
        </div>
        <div class="col-md-3">
            @include('common.notice')
        </div>
    </div>
</div>