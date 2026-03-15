@extends('layouts.app')

@section('title', $cerobong->cerobong_name . ' - CEMS')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <section id="apexchart">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ $cerobong->cerobong_name }}</h4>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div id="all"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach($activeParameters as $parameter)
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ $parameter->parameter_name }}<br><small>{{ $parameter->parameter_portion }}</small></h4>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div id="{{ $parameter->parameter_code }}"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section id="basic-datatable-status">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Status Pengiriman Data {{ $cerobong->cerobong_name }}</h4>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table id="datatablestatus" class="table nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Waktu</th>
                                                    <th class="text-center">Jam</th>
                                                    <th class="text-center">Status Pengiriman</th>
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

<div id="chart-data" 
     data-active-parameters='@json($activeParameters)' 
     data-cerobong-id="{{ $cerobong->cerobong_id }}"
     data-data-url="{{ url('cerobong') }}"
     data-status-url="{{ route('cerobong.status', $cerobong->cerobong_id) }}">
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    const chartDataEl = document.getElementById('chart-data');
    const activeParameters = JSON.parse(chartDataEl.getAttribute('data-active-parameters'));
    const cerobongId = chartDataEl.getAttribute('data-cerobong-id');
    const dataUrl = chartDataEl.getAttribute('data-data-url');
    const statusUrl = chartDataEl.getAttribute('data-status-url');
    
    const charts = {};

    activeParameters.forEach(parameter => {
        const options = {
            series: [],
            chart: {
                height: 350,
                type: 'line',
                zoom: { enabled: true }
            },
            colors: [parameter.parameter_color],
            annotations: {
                yaxis: [{
                    y: parameter.parameter_threshold,
                    borderColor: '#ff0000',
                    label: {
                        borderColor: '#ff0000',
                        style: { color: '#fff', background: '#ff0000' },
                        text: 'Threshold'
                    }
                }]
            },
            yaxis: { min: 0 },
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth' },
            tooltip: { x: { format: 'dd MMM yyyy HH:mm:ss' } },
            markers: { size: 1 },
            noData: { text: 'Loading...' },
            xaxis: { type: 'datetime', tickPlacement: 'on' }
        };
        const chart = new ApexCharts(document.querySelector("#" + parameter.parameter_code), options);
        chart.render();
        charts[parameter.parameter_code] = chart;
    });

    var all_options = {
        series: [],
        chart: {
            height: 350,
            type: 'line',
            zoom: { enabled: true }
        },
        colors: activeParameters.map(p => p.parameter_color),
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth' },
        tooltip: { x: { format: 'dd MMM yyyy HH:mm:ss' } },
        markers: { size: 1 },
        noData: { text: 'Loading...' },
        xaxis: { type: 'datetime', tickPlacement: 'on' }
    };
    var all_chart = new ApexCharts(document.querySelector('#all'), all_options);
    all_chart.render();

    function updateCharts() {
        activeParameters.forEach(parameter => {
            $.getJSON(dataUrl + "/" + cerobongId + "/data?p=" + parameter.parameter_code, function(response) {
                var threshold = parameter.parameter_threshold;
                var max_val = threshold;
                if (response.length > 0) {
                    var data_high = Math.max.apply(Math, response.map(function(o) { return o.y; }));
                    if (data_high > threshold) {
                        max_val = data_high + (0.1 * data_high);
                    }
                }

                charts[parameter.parameter_code].updateSeries([{
                    name: parameter.parameter_name,
                    data: response
                }]);
                
                charts[parameter.parameter_code].updateOptions({
                    yaxis: { min: 0, max: max_val }
                });
            });
        });

        // Update All chart
        var promises = [];
        activeParameters.forEach(parameter => {
            promises.push($.getJSON(dataUrl + "/" + cerobongId + "/data?p=" + parameter.parameter_code));
        });

        if (promises.length > 0) {
            $.when.apply($, promises).done(function() {
                var allSeries = [];
                var results = promises.length === 1 ? [arguments] : arguments;
                
                activeParameters.forEach((parameter, index) => {
                    var data = results[index][0];
                    allSeries.push({
                        name: parameter.parameter_name,
                        data: data
                    });
                });
                all_chart.updateSeries(allSeries);
            });
        }
    }

    function fetch_db_status() {
        $('#datatablestatus').DataTable().destroy();
        $('#datatablestatus').DataTable({
            responsive: true,
            autoWidth: false,
            'processing' : true,
            'serverSide' : true,
            'bFilter'	 : false,
            'columnDefs' : [{
                'targets' : 0,
                'className': 'text-center',
                'render' : function (data, type, row, meta) {
                    return data;
                }
            }, {
                'targets' : 1,
                'className': 'text-center',
                'render' : function (data, type, row, meta) {
                    return data;
                }
            }, {
                'targets' : 2,
                'className': 'text-center',
                'render' : function (data, type, row, meta) {
                    if (data == '' || data == null) {
                        return '<i class="fa fa-circle font-small-3 text-warning mr-50"></i>Belum Terkirim';
                    } else {
                        return '<i class="fa fa-circle font-small-3 text-success mr-50"></i>Terkirim';
                    }
                }
            }],
            'ajax' : statusUrl
        });
    }

    fetch_db_status();
    updateCharts();
    setInterval(updateCharts, 30000);
});
</script>
@endsection
