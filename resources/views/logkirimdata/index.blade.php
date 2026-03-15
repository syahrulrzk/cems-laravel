@extends('layouts.app')

@section('title', 'Log Kirim Data - CEMS')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <section>
                <div class="row">
                    <div class="col-12">
                        <div id="my_form"></div>
                        <div id="my_table">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div id="calendar"></div>
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
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: "{{ route('logkirimdata.json') }}",
        dateClick: function(info) {
            $.ajax({
                url: "{{ route('logkirimdata.fetch') }}",
                method: "POST",
                data: {
                    date: info.dateStr,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    $('#my_form').html(data);
                    $('#my_table').hide();
                }
            });
        }
    });
    calendar.render();

    $('body').on('click', '#close_btn', function() {
        $('#my_form').html('');
        $('#my_table').show();
    });
});
</script>
@endsection
