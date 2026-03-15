@extends('layouts.app')

@section('title', 'Activity Management - CEMS')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <section>
                <div class="row">
                    <div class="col-12">
                        <div class="card-group row">
                            <div class="card col-12 col-md-3">
                                <div class="card-content">
                                     <div class="card-body">
                                        <button id="add_btn" type="button" class="btn btn-primary btn-block" action="create">Add New</button>
                                        <br>
                                        <button class="btn btn-link activity_filter" value="all"><i class="feather icon-activity"></i> All</button>
                                        <hr>
                                        <h5 class="mb-1">Filters</h5>
                                        <button class="btn btn-link activity_filter" value="star"><i class="feather icon-star"></i> Starred</button>
                                        <br>
                                        <button class="btn btn-link activity_filter" value="complete"><i class="feather icon-check"></i> Completed</button>
                                        <br>
                                        <button class="btn btn-link activity_filter" value="trash"><i class="feather icon-trash"></i> Trashed</button>
                                        <hr>
                                        <h5 class="mb-1">Labels</h5>
                                        <button class="btn btn-link activity_filter" value="troubleshoot"><i class="fa fa-circle text-primary"></i> Troubleshoot</button>
                                        <br>
                                        <button class="btn btn-link activity_filter" value="service"><i class="fa fa-circle text-warning"></i> Service</button>
                                        <br>
                                        <button class="btn btn-link activity_filter" value="maintenance"><i class="fa fa-circle text-danger"></i> Maintenance</button>
                                     </div>
                                </div>
                            </div>
                            <div class="card col-12 col-md-9">
                                <div class="card-content">
                                     <div class="card-body">
                                        <div id="my_form"></div>
                                        <div id="my_table">
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input id="search_box" type="text" class="form-control" placeholder="Search activity..." autocomplete="off">
                                                <div class="form-control-position">
                                                    <i class="feather icon-search"></i>
                                                </div>
                                            </fieldset>
                                            <div class="table-responsive">
                                                <table id="datatable" class="table nowrap">
                                                    <thead style="display: none;">
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Activity</th>
                                                            <th>Category</th>
                                                            <th>Description</th>
                                                            <th>Date</th>
                                                            <th>Action</th>
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
                </div>
            </section>
        </div>
    </div>
</div>
<style>
.dataTables_length, .dataTables_filter {
    display: none;
}
</style>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    var current_cat = 'all';
    fetch_db();

    function fetch_db() {
        $('#datatable').DataTable().destroy();
        $('#datatable').DataTable({
            responsive: true,
            autoWidth: false,
            'processing' : true,
            'serverSide' : true,
            'ajax' : {
                url: '{{ route("activity.data") }}',
                data: { cat: current_cat }
            },
            'columnDefs' : [
                { 'visible' : false, 'targets' : [0, 2, 3] },
                {
                    'targets' : 1,
                    'render' : function (data, type, row, meta) {
                        var color = 'primary';
                        if (row[2] == 'service') color = 'warning';
                        if (row[2] == 'maintenance') color = 'danger';
                        
                        return '<div class="media"><div class="media-body"><h5 class="media-heading">'+data+' <span class="badge badge-dot badge-'+color+'"></span></h5><small class="text-muted">'+row[3]+'</small></div></div>';
                    }
                },
                {
                    'targets' : 4,
                    'render' : function (data, type, row, meta) {
                        return '<div class="text-right">'+data+'</div>';
                    }
                },
                {
                    'targets' : 5,
                    'render' : function (data, type, row, meta) {
                        return '<div class="text-right"><button id="edit_btn" class="btn btn-icon btn-flat-warning" action="update" value="'+data+'"><i class="feather icon-edit"></i></button><button id="remove_btn" class="btn btn-icon btn-flat-danger" action="delete" value="'+data+'"><i class="feather icon-x"></i></button></div>';
                    }
                }
            ]
        });
    }

    $('#search_box').keyup(function(){
        $('#datatable').DataTable().search($(this).val()).draw();
    });

    $('.activity_filter').click(function(){
        current_cat = $(this).val();
        fetch_db();
    });

    $('body').on('click', '#add_btn, #edit_btn, #remove_btn', function() {
        var action = $(this).attr('action');
        var id = $(this).attr('value');
        $.ajax({
            url : '{{ route("activity.fetch") }}',
            method : 'POST',
            data : {
                action: action, 
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success : function(data) {
                $('#my_form').html(data);
                $('#my_table').hide();
                $('.pickadate').pickadate({ format: 'yyyy-mm-dd', editable: true });
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
            url : '{{ route("activity.post") }}',
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
