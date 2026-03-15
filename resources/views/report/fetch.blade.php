<section id="apexchart">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Grafik rata - rata data pada tanggal {{ \App\Helpers\CemsHelper::tanggal($fromdate) }}<br>sampai tanggal {{ \App\Helpers\CemsHelper::tanggal($todate) }}</h4>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li>
                                <form action="{{ route('report.daterange.export') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="fromdate" value="{{ $fromdate }}">
                                    <input type="hidden" name="todate" value="{{ $todate }}">
                                    <input type="hidden" name="cerobong" value="{{ $cerobong_id }}">
                                    @foreach($prm as $p)
                                        <input type="hidden" name="prm[]" value="{{ $p }}">
                                    @endforeach
                                    <button type="submit" class="btn btn-success"><i class="feather icon-file-text"></i> Export Excel</button>
                                </form>
                            </li>
                            <li>
                                <form action="{{ route('report.daterange.exportpdf') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="fromdate" value="{{ $fromdate }}">
                                    <input type="hidden" name="todate" value="{{ $todate }}">
                                    <input type="hidden" name="cerobong" value="{{ $cerobong_id }}">
                                    @foreach($prm as $p)
                                        <input type="hidden" name="prm[]" value="{{ $p }}">
                                    @endforeach
                                    <button type="submit" class="btn btn-danger"><i class="feather icon-file"></i> Export PDF</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div id="capture" align="center"><div id="all"></div></div>
                        <hr>
                        <div class="table-responsive">
                            <table id="datatable2" class="table nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Cerobong</th>
                                        <th class="text-center">Parameter</th>
                                        <th class="text-center">Value</th>
                                        <th class="text-center">Waktu</th>
                                        <th class="text-center">Flow</th>
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

<div id="report-data"
     data-fromdate="{{ $fromdate }}"
     data-todate="{{ $todate }}"
     data-cerobong-id="{{ $cerobong_id }}"
     data-prm='@json($prm)'
     data-data-url="{{ route('report.daterange.data') }}"
     data-ssp-url="{{ route('report.daterange.ssp') }}">
</div>

<script>
$(document).ready(function () {
    const reportDataEl = document.getElementById('report-data');
    const fromdate = reportDataEl.getAttribute('data-fromdate');
    const todate = reportDataEl.getAttribute('data-todate');
    const cerobongId = reportDataEl.getAttribute('data-cerobong-id');
    const prm = JSON.parse(reportDataEl.getAttribute('data-prm'));
    const dataUrl = reportDataEl.getAttribute('data-data-url');
    const sspUrl = reportDataEl.getAttribute('data-ssp-url');

    var all_options = {
        series: [],
        chart: {
            height: 350,
            type: 'line',
            zoom: { enabled: true }
        },
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth' },
        noData: { text: 'Loading...' },
        xaxis: { categories: [] }
    };
    var all_chart = new ApexCharts(document.querySelector("#all"), all_options);
    all_chart.render();

    $.getJSON(dataUrl, {
        fromdate: fromdate,
        todate: todate,
        cerobong: cerobongId,
        prm: prm
    }, function(response) {
        var series = [];
        prm.forEach(param_code => {
            if (response[0]["name" + param_code]) {
                series.push({
                    name: response[0]["name" + param_code],
                    data: response[0]["data" + param_code]
                });
            }
        });
        all_chart.updateSeries(series);
        all_chart.updateOptions({
            xaxis: { categories: response[0].waktu }
        });
    });

    $('#datatable2').DataTable({
        responsive: true,
        autoWidth: false,
        'processing' : true,
        'serverSide' : true,
        'ajax' : {
            url: sspUrl,
            data: {
                fromdate: fromdate,
                todate: todate,
                cerobong: cerobongId,
                prm: prm
            }
        }
    });
});
</script>
