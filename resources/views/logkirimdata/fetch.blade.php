<div class="card">
    <div class="card-header">
        <h4 class="card-title">Log Kirim Data - {{ \App\Helpers\CemsHelper::tanggal($date) }}</h4>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><button id="close_btn" type="button" class="btn btn-icon btn-flat-danger"><i class="feather icon-x"></i></button></li>
            </ul>
        </div>
    </div>
    <div class="card-content">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table nowrap">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Log</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr>
                                <td>{{ \App\Helpers\CemsHelper::jam($log->date_start) }}</td>
                                <td>
                                    @if($log->status == 'sukses')
                                        <span class="badge badge-success">SUKSES</span>
                                    @else
                                        <span class="badge badge-danger">GAGAL</span>
                                    @endif
                                </td>
                                <td>{{ $log->log }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada log pengiriman data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
