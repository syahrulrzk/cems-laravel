@extends('layouts.app')

@section('title', 'Report By Date - CEMS')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <section>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form id="form" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12 col-md-5">
                                                <fieldset class="form-group">
                                                    <label>Dari Tanggal</label>
                                                    <input id="fromdate" type="text" class="form-control pickadate" name="fromdate" placeholder="Dari Tanggal" autocomplete="off" required="required">
                                                </fieldset>
                                                <fieldset class="form-group">
                                                    <label>Parameter</label>
                                                    <input id="cat" type="hidden" name="cat" value="all">
                                                    <select id="prm" class="form-control select2" name="prm[]" data-placeholder="Kategori" required="required" multiple>
                                                        @foreach($parameters as $parameter)
                                                            <option value="{{ $parameter->parameter_code }}">{{ $parameter->parameter_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-md-5">
                                                <fieldset class="form-group">
                                                    <label>Ke Tanggal</label>
                                                    <input id="todate" type="text" class="form-control pickadate" name="todate" placeholder="Ke Tanggal" autocomplete="off" required="required">
                                                </fieldset>
                                                <fieldset class="form-group">
                                                    <label>Cerobong</label>
                                                    <select id="cerobong" class="form-control select2" name="cerobong" data-placeholder="Cerobong" required="required">
                                                        <option></option>
                                                        @foreach($cerobongs as $cerobong)
                                                            <option value="{{ $cerobong->cerobong_id }}">{{ $cerobong->cerobong_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <fieldset class="form-group">
                                                    <label>&nbsp;</label>
                                                    <button id="submit_btn" type="submit" class="btn btn-primary btn-block"><i class="feather icon-search"></i> Cari</button>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div id="my_data"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    $('.pickadate').pickadate({
        format: 'mm/dd/yyyy',
        editable: true
    });

    $('#form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('report.daterange.fetch') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function(data) {
                $('#my_data').html(data);
            }
        });
    });
});
</script>
@endsection
