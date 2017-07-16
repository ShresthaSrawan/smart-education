@extends('layouts.app')

@section('title', 'Users:: create')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                User Create
                <a class="btn btn-sm btn-primary pull-right" href="{{ route('admin.index') }}">
                    <i class="glyphicon glyphicon-arrow-left"></i>
                    List
                </a>
            </div>
            <div class="panel-body">
                <form action="{{ route('admin.store') }}">
                    @include('admin.partials.form')
                </form>
            </div>
        </div>
    </div>
@stop

@push('scripts')
<script>
    var roles = JSON.parse('{!! json_encode($roles) !!}');
</script>
<script src="{{ mix('js/userform.js') }}"></script>
@endpush