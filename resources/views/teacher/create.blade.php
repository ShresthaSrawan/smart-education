@extends('layouts.app')

@section('title', 'Users:: create')

@section('content')
    <form action="{{ route('teacher.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="panel panel-default">
            <div class="panel-heading">
                User Create
                <a class="btn btn-sm btn-primary pull-right" href="{{ route('teacher.index') }}">
                    <i class="glyphicon glyphicon-arrow-left"></i>
                    List
                </a>
            </div>
            <div class="panel-body">
                @include('teacher.partials.form')
            </div>
            <div class="panel-footer text-right">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@stop