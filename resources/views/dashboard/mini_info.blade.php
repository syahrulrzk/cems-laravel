<div class="col-12 col-md-2">
    <div class="card text-center {{ $online ? 'bg-success' : 'bg-danger' }}">
        <div class="card-content">
            <div class="card-body">
                <div class="avatar bg-white p-50 m-0 mb-1">
                    <div class="avatar-content">
                        <i class="feather {{ $online ? 'icon-check text-success' : 'icon-x text-danger' }} font-medium-5"></i>
                    </div>
                </div>
                <h2 class="text-bold-700 text-white">{{ $online ? 'Online' : 'Offline' }}</h2>
                <p class="mb-0 line-ellipsis text-white">Status KLHK</p>
            </div>
        </div>
    </div>
</div>

<div class="col-12 col-md-2">
    <a href="{{ url('notif') }}?q=all_data">
        <div class="card text-center">
            <div class="card-content">
                <div class="card-body">
                    <div class="avatar bg-rgba-primary p-50 m-0 mb-1">
                        <div class="avatar-content">
                            <i class="feather icon-globe text-primary font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="text-bold-700 text-primary">{{ \App\Helpers\CemsHelper::singkat_angka($totalData) }}</h2>
                    <p class="mb-0 line-ellipsis text-primary">Total Data</p>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="col-12 col-md-2">
    <a href="{{ url('notif') }}?q=valid">
        <div class="card text-center">
            <div class="card-content">
                <div class="card-body">
                    <div class="avatar bg-rgba-success p-50 m-0 mb-1">
                        <div class="avatar-content">
                            <i class="feather icon-check-circle text-success font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="text-bold-700 text-success">{{ \App\Helpers\CemsHelper::singkat_angka($validData) }}</h2>
                    <p class="mb-0 line-ellipsis text-success">Valid</p>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="col-12 col-md-2">
    <a href="{{ url('notif') }}?q=calibrate">
        <div class="card text-center">
            <div class="card-content">
                <div class="card-body">
                    <div class="avatar bg-rgba-warning p-50 m-0 mb-1">
                        <div class="avatar-content">
                            <i class="feather icon-settings text-warning font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="text-bold-700 text-warning">{{ \App\Helpers\CemsHelper::singkat_angka($calibrateData) }}</h2>
                    <p class="mb-0 line-ellipsis text-warning">Calibrate</p>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="col-12 col-md-2">
    <a href="{{ url('notif') }}?q=invalid">
        <div class="card text-center">
            <div class="card-content">
                <div class="card-body">
                    <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                        <div class="avatar-content">
                            <i class="feather icon-alert-triangle text-danger font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="text-bold-700 text-danger">{{ \App\Helpers\CemsHelper::singkat_angka($invalidData) }}</h2>
                    <p class="mb-0 line-ellipsis text-danger">Invalid</p>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="col-12 col-md-2">
    <a href="{{ url('notif') }}?q=maintenance">
        <div class="card text-center">
            <div class="card-content">
                <div class="card-body">
                    <div class="avatar bg-rgba-secondary p-50 m-0 mb-1">
                        <div class="avatar-content">
                            <i class="feather icon-command text-secondary font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="text-bold-700 text-secondary">{{ \App\Helpers\CemsHelper::singkat_angka($maintenanceData) }}</h2>
                    <p class="mb-0 line-ellipsis text-secondary">Maintenance</p>
                </div>
            </div>
        </div>
    </a>
</div>
