@extends('layouts.app')

@section('content')
    @role('admin')
        @include('dashboards.admin')
    @endrole
    @role('teacher')
        @include('dashboards.teacher')
    @endrole
    @role('class-teacher')
        @include('dashboards.class-teacher')
    @endrole
    @role('parent')
        @include('dashboards.parent')
    @endrole
@endsection