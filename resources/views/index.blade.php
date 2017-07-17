@extends('layouts.app')

@section('content')
    @role('admin')
        @include('admin.dashboard')
    @endrole
    @role('teacher')
        @include('teacher.dashboard')
    @endrole
    @role('parent')
        @include('parent.dashboard')
    @endrole
@endsection