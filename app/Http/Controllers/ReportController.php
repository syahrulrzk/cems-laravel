<?php

namespace App\Http\Controllers;

use App\Models\Cerobong;
use App\Models\Parameter;
use App\Models\Data;
use App\Helpers\CemsHelper;
use App\Exports\CemsDataExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function exportExcel(Request $request)
    {
        $fromdate = date('Y-m-d', strtotime($request->fromdate));
        $todate = date('Y-m-d', strtotime($request->todate));
        $cerobong_id = $request->cerobong;
        $prm = $request->prm;

        $query = DB::table('data')
            ->join('cerobong', 'data.cerobong_id', '=', 'cerobong.cerobong_id')
            ->select('data.*', 'cerobong.cerobong_name')
            ->whereIn('data.parameter', $prm)
            ->where('data.cerobong_id', $cerobong_id)
            ->whereBetween('data.waktu', [$fromdate . ' 00:00:00', $todate . ' 23:59:59']);

        $data = $query->orderBy('data.waktu', 'asc')->get();

        return Excel::download(new CemsDataExport($data, $fromdate, $todate), 'laporan-cems-'.$fromdate.'-to-'.$todate.'.xlsx');
     }

     public function exportPdf(Request $request)
     {
         $fromdate = date('Y-m-d', strtotime($request->fromdate));
         $todate = date('Y-m-d', strtotime($request->todate));
         $cerobong_id = $request->cerobong;
         $prm = $request->prm;

         $query = DB::table('data')
             ->join('cerobong', 'data.cerobong_id', '=', 'cerobong.cerobong_id')
             ->select('data.*', 'cerobong.cerobong_name')
             ->whereIn('data.parameter', $prm)
             ->where('data.cerobong_id', $cerobong_id)
             ->whereBetween('data.waktu', [$fromdate . ' 00:00:00', $todate . ' 23:59:59']);

         $data = $query->orderBy('data.waktu', 'asc')->get();

         return Excel::download(new CemsDataExport($data, $fromdate, $todate), 'laporan-cems-'.$fromdate.'-to-'.$todate.'.pdf', ExcelType::DOMPDF);
     }

     public function byDateRange()
    {
        $cerobongs = Cerobong::all();
        $parameters = Parameter::all();
        return view('report.daterange', compact('cerobongs', 'parameters'));
    }

    public function fetch(Request $request)
    {
        $fromdate = date('Y-m-d', strtotime($request->fromdate));
        $todate = date('Y-m-d', strtotime($request->todate));
        $cerobong_id = $request->cerobong;
        $prm = $request->prm;
        $cat = $request->cat;

        return view('report.fetch', compact('fromdate', 'todate', 'cerobong_id', 'prm', 'cat'));
    }

    public function data(Request $request)
    {
        $fromdate = date('Y-m-d', strtotime($request->fromdate));
        $todate = date('Y-m-d', strtotime($request->todate));
        $cerobong_id = $request->cerobong;
        $prm = $request->prm;
        
        $response = [];
        $a = [];
        $a['waktu'] = [];

        foreach ($prm as $param_code) {
            $parameterData = Parameter::where('parameter_code', $param_code)->first();
            $dataQuery = DB::table('data')
                ->select(DB::raw('DATE(waktu) as tgl'), DB::raw('AVG(value) as val'))
                ->where('parameter', $param_code)
                ->where('cerobong_id', $cerobong_id)
                ->whereBetween('waktu', [$fromdate . ' 00:00:00', $todate . ' 23:59:59'])
                ->groupBy('tgl')
                ->orderBy('tgl', 'asc')
                ->get();

            if ($dataQuery->count() > 0) {
                $a['name' . $param_code] = $parameterData->parameter_name;
                foreach ($dataQuery as $data) {
                    $a['data' . $param_code][] = (float)$data->val;
                    if (!in_array(CemsHelper::tanggal($data->tgl), $a['waktu'])) {
                        $a['waktu'][] = CemsHelper::tanggal($data->tgl);
                    }
                }
            }
        }

        $response[] = $a;
        return response()->json($response);
    }

    public function ssp(Request $request)
    {
        $fromdate = date('Y-m-d', strtotime($request->fromdate));
        $todate = date('Y-m-d', strtotime($request->todate));
        $cerobong_id = $request->cerobong;
        $prm = $request->prm;

        $query = DB::table('data')
            ->join('cerobong', 'data.cerobong_id', '=', 'cerobong.cerobong_id')
            ->select('data.*', 'cerobong.cerobong_name')
            ->whereIn('data.parameter', $prm)
            ->where('data.cerobong_id', $cerobong_id)
            ->whereBetween('data.waktu', [$fromdate . ' 00:00:00', $todate . ' 23:59:59']);

        $totalRecords = $query->count();
        
        $start = $request->get('start');
        $length = $request->get('length');
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
                $item->laju_alir,
                $item->status,
                $item->fuel,
                $item->load,
                $item->status_sispek
            ];
        }

        return response()->json([
            "draw" => intval($request->get('draw')),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $formattedData
        ]);
    }

    public function byDate()
    {
        $cerobongs = Cerobong::all();
        $parameters = Parameter::all();
        return view('report.date', compact('cerobongs', 'parameters'));
    }

    public function byMonth()
    {
        $cerobongs = Cerobong::all();
        $parameters = Parameter::all();
        return view('report.month', compact('cerobongs', 'parameters'));
    }

    public function byYear()
    {
        $cerobongs = Cerobong::all();
        $parameters = Parameter::all();
        return view('report.year', compact('cerobongs', 'parameters'));
    }
}
