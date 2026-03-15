@extends('layouts.app')

@section('title', 'Settings - CEMS')

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
                                    <h4 class="card-title">Settings</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form id="form_upload" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 col-md-4">
                                                    <strong>Logo</strong>
                                                </div>
                                                <div id="logonya" class="col-12 col-md-8">
                                                    <img id="logo_preview" src="{{ \App\Helpers\CemsHelper::logo() }}" alt="" style="width: 100px; height: auto;">
                                                    <br><br>
                                                    <fieldset class="form-group">
                                                        <input id="logo" type="file" class="form-control-file" name="logo" accept="image/*">
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </form>
                                        <form id="form" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <hr>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <strong>Perusahaan</strong>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <fieldset class="form-group">
                                                        <input type="text" class="form-control" name="company" autocomplete="off" required="required" value="{{ \App\Helpers\CemsHelper::config('company') }}">
                                                    </fieldset>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <strong>Address</strong>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <fieldset class="form-group">
                                                        <textarea class="form-control" name="address" required="required">{{ \App\Helpers\CemsHelper::config('address') }}</textarea>
                                                    </fieldset>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <strong>Province</strong>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <fieldset class="form-group">
                                                        <select class="form-control select2" name="province" data-placeholder="" required="required" style="width: 100%;">
                                                            <option></option>
                                                            @foreach($provinces as $province)
                                                                <option value="{{ $province->province_id }}" {{ $province->province_id == \App\Helpers\CemsHelper::config('province') ? 'selected' : '' }}>{{ $province->province_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </fieldset>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <strong>No. Telp</strong>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <fieldset class="form-group">
                                                        <input type="text" class="form-control" name="phone" autocomplete="off" required="required" value="{{ \App\Helpers\CemsHelper::config('phone') }}">
                                                    </fieldset>
                                                </div>
                                                <div class="col-12">
                                                    <hr>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <strong>Client ID</strong>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <fieldset class="form-group">
                                                        <input type="text" class="form-control" name="client_id" autocomplete="off" required="required" value="{{ \App\Helpers\CemsHelper::config('client_id') }}">
                                                    </fieldset>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <strong>Secret ID</strong>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <fieldset class="form-group">
                                                        <input type="text" class="form-control" name="secret_id" autocomplete="off" required="required" value="{{ \App\Helpers\CemsHelper::config('secret_id') }}">
                                                    </fieldset>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <strong>Telegram (Bot Token)</strong>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <fieldset class="form-group">
                                                        <input type="text" class="form-control" name="telegram" autocomplete="off" value="{{ \App\Helpers\CemsHelper::config('telegram') }}">
                                                        <small class="text-muted">Opsional (untuk integrasi notifikasi Telegram).</small>
                                                    </fieldset>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <strong>Telegram Chat ID</strong>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <fieldset class="form-group">
                                                        <input type="text" class="form-control" name="telegram_chat_id" autocomplete="off" value="{{ \App\Helpers\CemsHelper::config('telegram_chat_id') }}">
                                                        <small class="text-muted">Opsional (ID Grup atau ID User Telegram).</small>
                                                    </fieldset>
                                                </div>
                                                <div class="col-12">
                                                    <hr>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <strong>Parameter</strong>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <fieldset class="form-group">
                                                        <select id="parameter_code" class="form-control select2" name="parameter_code[]" data-placeholder="" required="required" style="width: 100%;" multiple>
                                                            <option></option>
                                                            @foreach($parameters as $parameter)
                                                                <option value="{{ $parameter->parameter_code }}" {{ $parameter->parameter_status == 'active' ? 'selected' : '' }}>{{ $parameter->parameter_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </fieldset>
                                                </div>
                                                <div class="col-12">
                                                    <hr>
                                                </div>
                                                <div class="col-12">
                                                    <button id="submit_btn" type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
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
    $('.select2').select2();

    $('#logo').on('change', function() {
        var formData = new FormData($('#form_upload')[0]);
        $.ajax({
            url: "{{ route('setting.upload') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function(response) {
                if (response.success) {
                    $('#logo_preview').attr('src', response.logo_url);
                    toastr.success('Logo updated successfully');
                }
            },
            error: function() {
                toastr.error('Failed to upload logo');
            }
        });
    });

    $('#form').on('submit', function(e) {
        e.preventDefault();
        var $form = $(this);
        var formData = $form.serialize();
        $.ajax({
            url: "{{ route('setting.post') }}",
            type: "POST",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $form.find('input[name="_token"]').val()
            },
            success: function(response) {
                toastr.success(response);
            },
            error: function() {
                toastr.error('Failed to update settings');
            }
        });
    });
});
</script>
@endsection
