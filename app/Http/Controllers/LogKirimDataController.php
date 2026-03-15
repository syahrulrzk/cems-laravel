<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogKirimDataController extends Controller
{
    public function index()
    {
        return view('logkirimdata.index');
    }

    public function json()
    {
        $logs = DB::table('log_kirim_data')->get();
        $events = [];

        foreach ($logs as $log) {
            $events[] = [
                'title' => $log->status == 'sukses' ? '100' : '0',
                'start' => $log->date_start,
                'backgroundColor' => $log->status == 'sukses' ? '#28c76f' : '#ea5455',
                'borderColor' => $log->status == 'sukses' ? '#28c76f' : '#ea5455',
                'textColor' => '#ffffff'
            ];
        }

        return response()->json($events);
    }

    public function fetch(Request $request)
    {
        $date = $request->date;
        $logs = DB::table('log_kirim_data')
            ->whereDate('date_start', $date)
            ->get();

        return view('logkirimdata.fetch', compact('logs', 'date'));
    }
}
