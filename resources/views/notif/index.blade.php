@extends('layouts.app')

@section('title', 'Notifications - CEMS')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ ucfirst(str_replace('_', ' ', $q)) }}</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table id="datatable" class="table nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No.</th>
                                                    <th class="text-center">Cerobong</th>
                                                    <th class="text-center">Parameter</th>
                                                    <th class="text-center">Value</th>
                                                    <th class="text-center">Waktu</th>
                                                    <th class="text-center">Velocity</th>
                                                    <th class="text-center">Status Gas</th>
                                                    <th class="text-center">Status Partikulat</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Fuel</th>
                                                    <th class="text-center">Load</th>
                                                    <th class="text-center">Status Sispek</th>
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
            </section>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    $('#datatable').DataTable({
        responsive: true,
        autoWidth: false,
        'processing' : true,
        'serverSide' : true,
        'order' : [4, 'desc'],
        'ajax' : {
            url: '{{ route("notif.data") }}',
            data: { q: '{{ $q }}' }
        },
        'columnDefs' : [
            { 'className': 'text-center', 'targets': '_all' }
        ]
    });
});
</script>
@endsection
