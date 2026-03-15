<?php

namespace App\Http\Controllers;

use App\Models\Notif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q', 'all_data');
        return view('notif.index', compact('q'));
    }

    public function data(Request $request)
    {
        $q = $request->query('q', 'all_data');
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $query = DB::table('data')
            ->join('cerobong', 'data.cerobong_id', '=', 'cerobong.cerobong_id')
            ->select('data.*', 'cerobong.cerobong_name');

        if ($q == 'valid') $query->where('data.status', 'valid');
        if ($q == 'invalid') $query->where('data.status', 'invalid');
        if ($q == 'maintenance') $query->where('data.status', 'maintenance');
        // Add more filters as needed

        $totalRecords = $query->count();
        $data = $query->orderBy('data.waktu', 'desc')
                      ->offset($start)
                      ->limit($length)
                      ->get();

        $formattedData = [];
        foreach ($data as $index => $item) {
            $formattedData[] = [
                $index + $start + 1,
                $item->cerobong_name,
                $item->parameter,
                $item->value,
                $item->waktu,
                $item->velocity,
                $item->status_gas,
                $item->status_partikulat,
                $item->status,
                $item->fuel,
                $item->load,
                $item->status_sispek
            ];
        }

        return response()->json([
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $formattedData
        ]);
    }

    public function header()
    {
        $notifs = Notif::join('data', 'notif.notif_data', '=', 'data.id')
            ->join('parameter', 'data.parameter', '=', 'parameter.parameter_code')
            ->select('notif.*', 'data.waktu', 'data.value', 'parameter.parameter_name')
            ->orderBy('data.waktu', 'desc')
            ->limit(5)
            ->get();

        $count = Notif::where('notif_status', '0')->count();
        $data = [];

        foreach ($notifs as $n) {
            $data[] = [
                'title' => $n->parameter_name,
                'desc' => 'Value: ' . $n->value . ' at ' . $n->waktu,
                'time' => \App\Helpers\CemsHelper::jam($n->waktu)
            ];
        }

        return response()->json(['count' => $count, 'data' => $data]);
    }
}
