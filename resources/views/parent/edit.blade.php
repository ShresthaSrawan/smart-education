@extends('layouts.app')

@section('title', 'Users:: create')

@section('content')
    {{ Form::model($user, ['route' => ['parent.update', $user->username], 'method' => 'PUT']) }}
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Parent :: {{ $user->name }}
                <a class="btn btn-sm btn-primary pull-right" href="{{ route('parent.index') }}">
                    <i class="glyphicon glyphicon-arrow-left"></i>
                    List
                </a>
            </div>
            <div class="panel-body">
                @include('parent.partials.form')
            </div>
            <div class="panel-footer text-right">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    {{ Form::close() }}
@stop