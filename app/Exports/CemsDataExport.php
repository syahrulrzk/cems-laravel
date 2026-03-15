<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class CemsDataExport implements FromView, ShouldAutoSize, WithTitle
{
    protected $data;
    protected $fromdate;
    protected $todate;

    public function __construct($data, $fromdate, $todate)
    {
        $this->data = $data;
        $this->fromdate = $fromdate;
        $this->todate = $todate;
    }

    public function view(): View
    {
        return view('exports.cems_data', [
            'data' => $this->data,
            'fromdate' => $this->fromdate,
            'todate' => $this->todate
        ]);
    }

    public function title(): string
    {
        return 'Laporan CEMS ' . $this->fromdate . ' to ' . $this->todate;
    }
}
