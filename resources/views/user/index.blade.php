@extends('layouts.app')

@section('title', 'User Management - CEMS')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div id="my_form"></div>
                        <div id="my_table">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">User</h4>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><button id="add_btn" type="button" class="btn btn-icon btn-flat-primary" action="create"><i class="feather icon-plus"></i></button></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="datatable" class="table nowrap">
                                                <thead>
                                                    <tr>
                                                        <th><center>No.</center></th>
                                                        <th><center>Email</center></th>
                                                        <th><center>Password</center></th>
                                                        <th><center>Nama Lengkap</center></th>
                                                        <th><center>Hak Akses</center></th>
                                                        <th><center>Terima Notif</center></th>
                                                        <th><center>Action</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    fetch_db();
    function fetch_db() {
        $('#datatable').DataTable().destroy();
        $('#datatable').DataTable({
            responsive: true,
            autoWidth: false,
            'processing' : true,
            'serverSide' : true,
            'order' : [0, 'desc'],
            'columnDefs' : [{
                'visible' : false,
                'targets' : 0
            }, {
                'targets' : 1,
                'data' : 1,
                'render' : function (data, type, row, meta) {
                    return '<div class="text-center">'+data+'</div>';
                }
            }, {
                'targets' : 2,
                'data' : 2,
                'render' : function (data, type, row, meta) {
                    return '<div class="text-center"><button id="password_btn" type="button" class="btn btn-icon btn-flat-primary" action="password" value="'+data+'"><i class="feather icon-lock"></i></button></div>';
                }
            }, {
                'targets' : 3,
                'data' : 3,
                'render' : function (data, type, row, meta) {
                    return '<div class="text-center">'+data+'</div>';
                }
            }, {
                'targets' : 4,
                'data' : 4,
                'render' : function (data, type, row, meta) {
                    return '<div class="text-center">'+data+'</div>';
                }
            }, {
                'targets' : 5,
                'data' : 5,
                'render' : function (data, type, row, meta) {
                    if (data == 1) {
                        return '<div class="text-center"><span class="badge badge-success">YA</span></div>';
                    } else {
                        return '<div class="text-center"><span class="badge badge-danger">TIDAK</span></div>';
                    }
                }
            }, {
                'targets' : 6,
                'data' : 6,
                'render' : function (data, type, row, meta) {
                    return '<div class="text-center"><button id="edit_btn" type="button" class="btn btn-icon btn-flat-warning" action="update" value="'+data+'"><i class="feather icon-edit"></i></button><button id="remove_btn" type="button" class="btn btn-icon btn-flat-danger" action="delete" value="'+data+'"><i class="feather icon-x"></i></button></div>';
                }
            }],
            'ajax' : '{{ route("user.data") }}'
        });
    }

    $('body').on('click', '#add_btn, #edit_btn, #remove_btn, #password_btn', function() {
        var action = $(this).attr('action');
        var id = $(this).attr('value');
        $.ajax({
            url : '{{ route("user.fetch") }}',
            method : 'POST',
            data : {
                action: action, 
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success : function(data) {
                $('#my_form').html(data);
                $('#my_table').hide();
                $('.select2').select2();
            }
        });
    });

    $('body').on('click', '#close_btn', function() {
        $('#my_form').html('');
        $('#my_table').show();
    });

    $('body').on('submit', '#form', function(e) {
        e.preventDefault();
        $.ajax({
            url : '{{ route("user.post") }}',
            method : 'POST',
            data : $('#form').serialize() + '&_token={{ csrf_token() }}',
            beforeSend: function() {
                $('#submit_btn').text('Loading');
                $('#submit_btn').attr('disabled', true);
            },
            success : function(data) {
                $('#close_btn').click();
                toastr.success(data, 'Success!');
                fetch_db();
            },
            error: function(xhr) {
                toastr.error('Something went wrong', 'Error!');
                $('#submit_btn').text('Simpan');
                $('#submit_btn').attr('disabled', false);
            }
        });
    });
});
</script>
@endsection
