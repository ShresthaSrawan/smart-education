<div class="post">
    <div class="post-heading">
        <div class="row">
            <div class="col-xs-2">
                <img src="http://lorempixel.com/70/70/cats" src="img-circle">
            </div>
            <div class="col-xs-10">
                <div class="row">
                    <div class="col-xs-12">
                        Robert Wiz
                    </div>
                    <div class="col-xs-12">
                        {{ date('D j, M Y') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="post-body">
        <div class="post-thumbnail">
            <img src="http://lorempixel.com/600/300/cats/" class="img-responsive">
        </div>
        <div class="post-detail">
            <p>
                {!! $slot !!}
            </p>
        </div>
    </div>
</div>