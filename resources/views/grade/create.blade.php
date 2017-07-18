@extends('layouts.app')

@section('title', 'Grades:: create')

@section('content')
    <div class="container">
        <form action="{{ route('grade.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="panel panel-default">
                <div class="panel-heading">
                    Grade Create
                    <a class="btn btn-sm btn-primary pull-right" href="{{ route('grade.index') }}">
                        <i class="glyphicon glyphicon-arrow-left"></i>
                        List
                    </a>
                </div>
                <div class="panel-body">
                    @include('grade.partials.form')
                </div>
                <div class="panel-footer text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
@stop