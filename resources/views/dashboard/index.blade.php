@extends('layouts.app')

@section('title', 'Dashboard - CEMS')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <section id="dashboard-analytics">
                <div id="mini_alert" class="row">
                    <div class="col-12">
                        <p class="text-center bg-white">Loading...</p>
                    </div>
                </div>
                <div id="mini_info" class="row">
                    <div class="col-12">
                        <p class="text-center bg-white">Loading...</p>
                    </div>
                </div>
                
                <div class="row">
                    @foreach($activeParameters as $parameter)
                        <div class="col-12 col-md-4">
                            <div class="card">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <h4 class="text-bold-700 mt-1 mb-25">{{ $parameter->parameter_name }}</h4>
                                    <p class="mb-0">{{ $parameter->parameter_portion }}</p>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div id="{{ $parameter->parameter_code }}"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12 col-md-4">
                        <div class="card">
                            <div class="card-header d-flex flex-column align-items-start pb-0">
                                <h4 class="text-bold-700 mt-1 mb-25">Flow</h4>
                                <p class="mb-0">m3/s</p>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <div id="flow"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($cerobongs as $cerobong)
                        <div id="cerobong{{ $cerobong->cerobong_id }}_chart" class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ $cerobong->cerobong_name }}</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div id="all{{ $cerobong->cerobong_id }}"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</div>

<div id="dashboard-data"
     data-active-parameters='@json($activeParameters)'
     data-cerobongs='@json($cerobongs)'
     data-data-url="{{ route('dashboard.data') }}"
     data-mini-alert-url="{{ route('dashboard.mini_alert') }}"
     data-mini-info-url="{{ route('dashboard.mini_info') }}">
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    const dashboardDataEl = document.getElementById('dashboard-data');
    const activeParameters = JSON.parse(dashboardDataEl.getAttribute('data-active-parameters'));
    const cerobongs = JSON.parse(dashboardDataEl.getAttribute('data-cerobongs'));
    const dataUrl = dashboardDataEl.getAttribute('data-data-url');
    const miniAlertUrl = dashboardDataEl.getAttribute('data-mini-alert-url');
    const miniInfoUrl = dashboardDataEl.getAttribute('data-mini-info-url');

    const paramCharts = {};
    const allCharts = {};

    const paramColors = {
        'NOx': ['#bfbfbf', '#7367f0'],
        'SO2': ['#bfbfbf', '#28c76f'],
        'PM': ['#bfbfbf', '#ff9f43'],
        'CO2': ['#bfbfbf', '#00cfe8'],
        'Hg': ['#bfbfbf', '#ff0000'],
        'O2': ['#bfbfbf', '#ffff00'],
        'Temp': ['#bfbfbf', '#ff00ff'],
    };

    activeParameters.forEach(parameter => {
        const options = {
            series: [],
            chart: {
                height: 100,
                type: 'line',
                toolbar: { show: false },
                sparkline: { enabled: true }
            },
            colors: paramColors[parameter.parameter_code] || ['#bfbfbf', '#7367f0'],
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 2.5 },
            noData: { text: 'Loading...' },
            xaxis: {
                labels: { show: false },
                axisBorder: { show: false }
            },
            yaxis: [{
                y: 0,
                offsetX: 0,
                offsetY: 0,
                padding: { left: 0, right: 0 }
            }],
            tooltip: { enabled: true }
        };
        const chart = new ApexCharts(document.querySelector("#" + parameter.parameter_code), options);
        chart.render();
        paramCharts[parameter.parameter_code] = chart;
    });
    
    var flow_options = {
        series: [],
        chart: {
            height: 100,
            type: 'line',
            toolbar: { show: false },
            sparkline: { enabled: true }
        },
        colors: ['#bfbfbf', '#7367f0'],
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 2.5 },
        noData: { text: 'Loading...' },
        xaxis: {
            labels: { show: false },
            axisBorder: { show: false }
        },
        yaxis: [{
            y: 0,
            offsetX: 0,
            offsetY: 0,
            padding: { left: 0, right: 0 }
        }],
        tooltip: { enabled: true }
    }
    
    var flow_chart = new ApexCharts(document.querySelector("#flow"), flow_options);
    flow_chart.render();
    
    cerobongs.forEach(cerobong => {
        const options = {
            series: [],
            chart: {
                height: 350,
                type: 'line',
                zoom: { enabled: true }
            },
            colors: [...activeParameters.map(p => p.parameter_color), "#bfbfbf"],
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth' },
            grid: {
                borderColor: '#e7e7e7',
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            markers: {
                size: 1
            },
            xaxis: {
                type: 'datetime',
                labels: {
                    datetimeUTC: false
                }
            },
            tooltip: {
                x: {
                    format: 'dd MMM yyyy HH:mm'
                }
            }
        };
        const chart = new ApexCharts(document.querySelector("#all" + cerobong.cerobong_id), options);
        chart.render();
        allCharts[cerobong.cerobong_id] = chart;
    });

    function updateWidgets() {
        $('#mini_alert').load(miniAlertUrl);
        $('#mini_info').load(miniInfoUrl);
    }

    function updateCharts() {
        activeParameters.forEach(param => {
            $.getJSON(dataUrl + "?cat=param&q=" + param.parameter_code, function(response) {
                var series = [];
                cerobongs.forEach(cerobong => {
                    series.push({
                        name: response[0]["name" + cerobong.cerobong_id],
                        data: response[0]["data" + cerobong.cerobong_id]
                    });
                });
                paramCharts[param.parameter_code].updateSeries(series);
                paramCharts[param.parameter_code].updateOptions({
                    xaxis: { categories: response[0].waktu }
                });
            });
        });

        $.getJSON(dataUrl + "?cat=param&q=flow", function(response) {
            var series = [];
            cerobongs.forEach(cerobong => {
                series.push({
                    name: response[0]["name" + cerobong.cerobong_id],
                    data: response[0]["data" + cerobong.cerobong_id]
                });
            });
            flow_chart.updateSeries(series);
            flow_chart.updateOptions({
                xaxis: { categories: response[0].waktu }
            });
        });

        cerobongs.forEach(cerobong => {
            $.getJSON(dataUrl + "?cat=all&q=" + cerobong.cerobong_id, function(response) {
                var series = [];
                activeParameters.forEach(parameterData => {
                    if (response[0]["name" + parameterData.parameter_id]) {
                        series.push({
                            name: response[0]["name" + parameterData.parameter_id],
                            type: response[0]["type" + parameterData.parameter_id],
                            data: response[0]["data" + parameterData.parameter_id]
                        });
                    }
                });
                series.push({
                    name: response[0].nameflow,
                    type: response[0].typeflow,
                    data: response[0].dataflow
                });
                allCharts[cerobong.cerobong_id].updateSeries(series);
                allCharts[cerobong.cerobong_id].updateOptions({
                    xaxis: { categories: response[0].waktu }
                });
            });
        });
    }

    updateWidgets();
    updateCharts();
    setInterval(updateWidgets, 60000); // Refresh widgets every 60s
    setInterval(updateCharts, 30000); // Refresh charts every 30s
});
</script>
@endsection
