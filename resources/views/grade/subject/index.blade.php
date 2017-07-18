@extends('layouts.app')

@section('title', 'Subject')

@section('content')
    <div class="container" id="app">
        <div class="panel panel-default">
            <div class="panel-heading">
                Subjects
                <div class="pull-right">
                    <button class="btn btn-sm" type="button" data-toggle="modal" data-target="#subjectModal"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            <div class="panel-body">
                @forelse($subjects as $subject)
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <button type="button" class="pull-right"><i class="fa fa-close"></i></button>
                            {{ $subject->name }} taught by {{ $subject->teacher->name }}
                        </div>
                    </div>
                @empty
                    <div>No Subjects associated to this Grade. Add one?</div>
                @endforelse
            </div>
        </div>

        <!-- Modal -->
        <form action="{{ route('grade.subject.store', $grade->slug) }}" method="POST">
            {{ csrf_field() }}
            <div class="modal fade" id="subjectModal" tabindex="-1" role="dialog" aria-labelledby="subjectModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="subjectModalLabel">Add Subject</h4>
                        </div>
                        <div class="modal-body">
                            @include('grade.subject.partials.form')
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-close-subject" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection