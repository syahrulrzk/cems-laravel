@extends('layouts.app')

@section('title', 'Submit Data - CEMS')

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
                                    <h4 class="card-title">Submit data</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <hr>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <strong>Kirim data otomatis</strong>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <div class="custom-control custom-switch custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input action-kirim" id="iskirim" />
                                                    <label class="custom-control-label" for="iskirim"></label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <hr>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <strong>Kirim data manual</strong>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="feather icon-calendar"></i></span>
                                                    </div>
                                                    <input id="fromdate" type="text" class="form-control pickadate" name="fromdate" placeholder="Date" autocomplete="off" required="required">
                                                    <input id="fromtime" type="text" class="form-control pickatime" name="fromtime" placeholder="Time" autocomplete="off" required="required">
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <button id="submit_btn" type="submit" class="btn btn-primary action-submit">Kirim</button>
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
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    $('.pickadate').pickadate({
        format: 'mm/dd/yyyy',
        editable: true
    });
    $('.pickatime').pickatime({
        format: 'HH:i',
        interval: 60,
        editable: true
    });

    $.ajax({
        url: "{{ route('kirim.status') }}",
        dataType: "json",
        type: "GET",
        success: function(data) {
            if (data.isKirim == '1') {
                $('#iskirim').prop('checked', true);
            } else {
                $('#iskirim').prop('checked', false);
            }
        }
    });
});

$(document).on('click', '.action-kirim', function () {
    var iskirim = $('#iskirim').is(':checked') ? 1 : 0;
    $.ajax({
        url: "{{ route('kirim.update') }}",
        dataType: "json",
        data: {
            iskirim: iskirim,
            _token: '{{ csrf_token() }}'
        },
        type: "POST",
        success: function(data) {
            if (iskirim == 1) {
                toastr.success('Sukses hidupkan kirim data otomatis', 'Success');
            } else {
                toastr.success('Sukses matikan kirim data otomatis', 'Success');
            }
        }
    });
});

$(document).on('click', '.action-submit', function () {
    var fromdate = $('#fromdate').val();
    var fromtime = $('#fromtime').val();
    if(fromdate != '' && fromtime != ''){
        var splitdate = fromdate.split("/");
        var newdate = splitdate[2]+"-"+splitdate[0]+"-"+splitdate[1];
        var datetime = newdate+' '+fromtime+":00";
        
        $.ajax({
            url: "{{ route('kirim.manual') }}?datetime="+datetime,
            dataType: "json",
            type: "GET",
            success: function(data) {
                toastr.success(data.message, 'Sukses submit data');
            },
            error: function() {
                toastr.error('Gagal submit data', 'Error');
            }
        });
    }else{
        toastr.warning('Tanggal dan Waktu tidak boleh kosong', 'Submit data');
    }
});
</script>
@endsection
