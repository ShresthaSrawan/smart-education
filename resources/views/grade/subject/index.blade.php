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
                <div v-if="!fetching">
                    <div v-if="!subjects.length">No Subjects associated to this Grade. Add one?</div>
                </div>
                <div v-else>
                    Loading...
                </div>
                <div class="panel panel-default" v-for="subject in subjects">
                    <div class="panel-body">
                        <button type="button" class="pull-right" @click="removeSubject(subject)" :disabled="subject.removing"><i class="fa fa-close"></i></button>
                        @{{ subject.name }} taught by @{{ subject.teacher.name }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="subjectModal" tabindex="-1" role="dialog" aria-labelledby="subjectModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="subjectModalLabel">Add Subject</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name (required)</label>
                            <input id="name" type="text" name="name" v-model="new_subject.name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="teacher_id">Teacher (required)</label>
                            <select id="teacher_id" v-model="new_subject.teacher_id" class="form-control">
                                @foreach($teachers as $id => $teacher)
                                    <option value="{{ $id }}">{{ $teacher }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-close-subject" data-dismiss="modal" :disabled="saving">Close</button>
                        <button type="button" class="btn btn-primary" @click="addSubject" :disabled="saving || !new_subject.name || !new_subject.teacher_id">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>var grade = '{{ $grade->slug }}';</script>
    <script src="{{ mix('js/subject.js') }}"></script>
@endpush