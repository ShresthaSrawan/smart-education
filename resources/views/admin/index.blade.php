@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Admin List
            <a class="btn btn-sm btn-primary pull-right" href="{{ route('admin.create') }}">
                <i class="glyphicon glyphicon-plus"></i>
                Add
            </a>
        </div>
        <div class="panel-body">
            <table id="dt_user" class="table order-column hover" data-source="{{route('admin.datatable')}}">
                <thead>
                    <tr>
                        <th>AVATAR</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
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
            var table = $('#dt_user').DataTable({
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
                    "url": $('#dt_user').data('source')
                },
                "pageLength": "25",
                "columns": [
                    {"data": "first_name", "name": "first_name"},
                    {"data": "first_name", "name": "first_name"},
                    {"data": "email", "name": "email"},
                    {"data": "username","class": "text-right", "orderable": false, "render": function(data,meta, row) {
                        return "<form method='POST' action='/parent/"+data+"'>" +
                            "<div class='uk-button-group'>" +
                            "<a href='/parent/"+data+"' class='btn btn-sm'>view</a>" +
                            "<a href='/parent/"+data+"/edit' class='btn btn-sm'>edit</a>" +
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