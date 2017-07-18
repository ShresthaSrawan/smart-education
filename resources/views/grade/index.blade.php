@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                User List
                <a class="btn btn-sm btn-primary pull-right" href="{{ route('grade.create') }}">
                    <i class="glyphicon glyphicon-plus"></i>
                    Add
                </a>
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