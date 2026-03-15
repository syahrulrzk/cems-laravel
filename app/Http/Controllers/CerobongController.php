<?php

namespace App\Http\Controllers;

use App\Models\Cerobong;
use App\Models\Data;
use App\Models\Parameter;
use App\Helpers\CemsHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CerobongController extends Controller
{
    public function show($id)
    {
        $cerobong = Cerobong::findOrFail($id);
        $activeParameters = Parameter::where('parameter_status', 'active')->get();
        
        return view('cerobong.show', compact('cerobong', 'activeParameters'));
    }

    public function getData(Request $request, $id)
    {
        $parameter = $request->query('p');
        $limit = $request->query('l', 25);
        
        $data = Data::where('cerobong_id', $id)
            ->where('parameter', $parameter)
            ->orderBy('waktu', 'desc')
            ->limit($limit)
            ->get()
            ->reverse();
            
        $formattedData = [];
        foreach ($data as $item) {
            $formattedData[] = [
                'x' => CemsHelper::timestamp($item->waktu),
                'y' => (float)$item->value
            ];
        }
            
        return response()->json($formattedData);
    }

    public function getStatus(Request $request, $id)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $monthsago = date('Y-m-d', strtotime('-3 months'));

        // Use a subquery to handle grouping and counting correctly in strict mode
        $subQuery = DB::table('data')
            ->select(
                DB::raw("DATE_FORMAT(waktu, '%Y-%m-%d') as tanggal"),
                DB::raw("HOUR(waktu) as jam"),
                'status_sispek',
                DB::raw("MAX(waktu) as max_waktu")
            )
            ->whereBetween('waktu', [$monthsago . ' 00:00:00', now()])
            ->where('cerobong_id', $id)
            ->groupBy(DB::raw("DATE_FORMAT(waktu, '%Y-%m-%d')"), DB::raw("HOUR(waktu)"), 'status_sispek');

        $totalRecords = DB::table(DB::raw("({$subQuery->toSql()}) as sub"))
            ->mergeBindings($subQuery)
            ->count();

        $data = $subQuery->orderBy('max_waktu', 'desc')
            ->offset($start)
            ->limit($length)
            ->get();

        $formattedData = [];
        foreach ($data as $item) {
            $formattedData[] = [
                $item->tanggal,
                $item->jam . ':00-' . ($item->jam + 1) . ':00',
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

    public function apiIndex()
    {
        $cerobong = Cerobong::all();
        return response()->json([
            'success' => true,
            'data' => $cerobong
        ]);
    }

    public function apiShow($id)
    {
        $cerobong = Cerobong::with(['data', 'parameters'])->findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $cerobong
        ]);
    }
}
