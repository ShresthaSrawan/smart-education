@extends('layouts.app')

@section('title', 'Grades')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                Grade List
                <button class="btn btn-sm pull-right" type="button" data-toggle="modal" data-target="#subjectModal"><i class="fa fa-plus"></i></button>
            </div>
            <div class="panel-body">
                <table id="dt_grade" class="table order-column hover" data-source="{{route('grade.datatable')}}">
                    <thead>
                        <tr>
                            <th>AVATAR</th>
                            <th>GRADE</th>
                            <th>CLASS TEACHER</th>
                            <th>SUBJECTS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <form action="{{ route('grade.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="modal fade" id="subjectModal" tabindex="-1" role="dialog" aria-labelledby="subjectModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="subjectModalLabel">Add Subject</h4>
                    </div>
                    <div class="modal-body">
                        @include('grade.partials.form')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-close-subject" data-dismiss="modal" :disabled="saving">Close</button>
                        <button type="button" class="btn btn-primary" :disabled="saving || !new_subject.name || !new_subject.teacher_id">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/css/dataTables.bootstrap.css">
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            var table = $('#dt_grade').DataTable({
                "dom": "rBftip",
                "language": {
                    "processing": "<h2 id='dt_loading'><span class='fa fa-spinner fa-pulse'></span> Loading...</h2>"
                },
                "buttons": [
                    'pageLength', 'colvis'
                ],
                "order": [],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "type": "POST",
                    "data": {"_token": "{{ csrf_token() }}"},
                    "url": $('#dt_grade').data('source')
                },
                "pageLength": "25",
                "columns": [
                    {"data": "name", "name": "name"},
                    {"data": "name", "name": "name"},
                    {"data": "class_teacher_id", "name": "class_teacher_id", "render": function(data, meta, row) {
                        return data ? row.class_teacher.name: '-';
                    }},
                    {"data": "name", "name": "name", "render": function(data, meta, row) {
                        return row.subjects ? row.subjects.length: 0;
                    }},
                    {"data": "slug","class": "text-right", "orderable": false, "render": function(data,meta, row) {
                        return "<form method='POST' action='/grade/"+data+"'>" +
                            "<div class='uk-button-group'>" +
                            "<a href='/grade/"+data+"' class='btn btn-sm'>view</a>" +
                            "<a href='/grade/"+data+"/edit' class='btn btn-sm'>edit</a>" +
                            "<a href='/grade/"+data+"/subject' class='btn btn-sm'>Manage Subjects</a>" +
                            '{!! method_field('DELETE') !!}' +
                            '{!! csrf_field() !!}' +
                            "<button type='button' class='btn-delete btn btn-sm btn-danger' data-name='"+row.name+"'>remove</button> "+
                            "</div>" +
                            "</form>";
                    }}
                ]
            });

            $(document).on('click', '.btn-delete',function () {
                var that = this;
                var name = $(that).data('name');
                $(that).closest('form').submit();
            });
        });
    </script>
@endpush