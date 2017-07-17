@extends('layouts.app')

@section('title', 'Users:: create')

@section('content')
    <div class="container">
        <form action="{{ route('admin.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="panel panel-default">
                <div class="panel-heading">
                    User Create
                    <a class="btn btn-sm btn-primary pull-right" href="{{ route('admin.index') }}">
                        <i class="glyphicon glyphicon-arrow-left"></i>
                        List
                    </a>
                </div>
                <div class="panel-body">
                    @include('admin.partials.form')
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
@stop