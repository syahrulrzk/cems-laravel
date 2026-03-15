@extends('layouts.app')

@section('title', 'Report By Date Range - CEMS')

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
                                            <div class="col-12 col-md-3">
                                                <fieldset class="form-group">
                                                    <label>Dari Tanggal</label>
                                                    <input id="fromdate" type="text" class="form-control pickadate" name="fromdate" placeholder="Dari Tanggal" autocomplete="off" required="required">
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <fieldset class="form-group">
                                                    <label>Parameter</label>
                                                    <input id="cat" type="hidden" name="cat" value="all">
                                                    <div class="dropdown custom-dropdown-checkbox w-100">
                                                        <button class="btn btn-outline-secondary dropdown-toggle w-100 text-left d-flex justify-content-between align-items-center" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-radius: 8px; border: 1px solid #e2e8f0; background: #fff; color: #495057;">
                                                            <span id="param-btn-text" class="text-truncate" style="max-width: 85%;">Pilih Parameter</span>
                                                            <i class="feather icon-chevron-down"></i>
                                                        </button>
                                                        <div class="dropdown-menu w-100 p-2 shadow" aria-labelledby="dropdownMenuButton" style="max-height: 250px; overflow-y: auto; border-radius: 8px; border: none;">
                                                            <div class="custom-control custom-checkbox mb-2 pb-2 border-bottom">
                                                                <input type="checkbox" class="custom-control-input" id="checkAllParam">
                                                                <label class="custom-control-label font-weight-bold text-primary" for="checkAllParam" style="cursor: pointer;">Pilih Semua</label>
                                                            </div>
                                                            <div id="param-list">
                                                                @foreach($parameters as $parameter)
                                                                    <div class="custom-control custom-checkbox my-1">
                                                                        <input type="checkbox" class="custom-control-input param-checkbox" id="param-{{ $parameter->parameter_code }}" name="prm[]" value="{{ $parameter->parameter_code }}">
                                                                        <label class="custom-control-label w-100" for="param-{{ $parameter->parameter_code }}" style="cursor: pointer;">{{ $parameter->parameter_name }}</label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-md-2">
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
                                            <div class="col-12 col-md-1">
                                                <fieldset class="form-group">
                                                    <label>&nbsp;</label>
                                                    <button id="submit_btn" type="submit" class="btn btn-primary btn-block"><i class="feather icon-search"></i></button>
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

    // Handle Custom Dropdown Checkbox Logic
    $('.custom-dropdown-checkbox .dropdown-menu').on({
        "click": function(e) {
            e.stopPropagation(); // Biar ga otomatis ketutup pas diklik di dalam dropdown
        }
    });

    function updateBtnText() {
        var total = $('.param-checkbox').length;
        var checkedItems = $('.param-checkbox:checked');
        var checked = checkedItems.length;
        var btnText = $('#param-btn-text');

        if (checked === 0) {
            btnText.text('Pilih Parameter');
        } else if (checked === total) {
            btnText.text('Semua Terpilih (' + checked + ')');
        } else {
            var selectedNames = [];
            checkedItems.each(function() {
                var label = $(this).siblings('label').text();
                selectedNames.push(label);
            });
            btnText.text(selectedNames.join(', '));
        }

        // Kalau semua kecentang manual, "Pilih Semua" otomatis dicentang
        $('#checkAllParam').prop('checked', checked === total);
    }

    // Event saat "Pilih Semua" diklik
    $('#checkAllParam').on('change', function() {
        var isChecked = $(this).is(':checked');
        $('.param-checkbox').prop('checked', isChecked);
        updateBtnText();
    });

    // Event saat salah satu parameter diklik
    $('.param-checkbox').on('change', function() {
        updateBtnText();
    });

    $('#form').on('submit', function(e) {
        e.preventDefault();
        
        // Validasi minimal 1 parameter terpilih
        if ($('.param-checkbox:checked').length === 0) {
            toastr.error('Pilih minimal 1 parameter terlebih dahulu.', 'Oops!');
            return;
        }

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
