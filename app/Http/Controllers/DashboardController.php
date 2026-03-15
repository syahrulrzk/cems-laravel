<?php

namespace App\Http\Controllers;

use App\Models\Cerobong;
use App\Models\Data;
use App\Models\Parameter;
use App\Helpers\CemsHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $cerobongs = DB::table('cerobong')->get();
        $activeParameters = DB::table('parameter')->where('parameter_status', 'active')->get();
        return view('dashboard.index', compact('cerobongs', 'activeParameters'));
    }

    public function miniAlert()
    {
        $count = DB::table('notif')
            ->join('data', 'notif.notif_data', '=', 'data.id')
            ->where('data.status', 'valid')
            ->count();

        return view('dashboard.mini_alert', compact('count'));
    }

    public function miniInfo()
    {
        $host = 'ppmu.kemenlh.go.id';
        $online = false;
        if ($socket = @fsockopen($host, 80, $errno, $errstr, 5)) {
            $online = true;
            fclose($socket);
        }

        $totalData = DB::table('data')->count();
        $validData = DB::table('data')->where('status', 'valid')->count();
        $calibrateData = DB::table('data')->where('status', 'calibrate')->count();
        $invalidData = DB::table('data')->where('status', 'invalid')->count();
        $maintenanceData = DB::table('data')->where('status', 'maintenance')->count();

        return view('dashboard.mini_info', compact(
            'online', 'totalData', 'validData', 'calibrateData', 'invalidData', 'maintenanceData'
        ));
    }

    public function getData(Request $request)
    {
        $cat = $request->query('cat');
        $q = $request->query('q');
        $response = [];

        if ($cat == 'param') {
            $a = [];
            $cerobongs = DB::table('cerobong')->get();
            $parameter = $q == 'flow' ? 'SO2' : $q;

            // Get the latest unique timestamps for this parameter
            $timestamps = DB::table('data')
                ->where('parameter', $parameter)
                ->select('waktu')
                ->distinct()
                ->orderBy('waktu', 'desc')
                ->limit(15) // Increased from 7 to 15 for better chart view
                ->pluck('waktu')
                ->reverse()
                ->values();

            $a['waktu'] = $timestamps->map(function($t) {
                return CemsHelper::timestamp($t);
            })->toArray();

            foreach ($cerobongs as $cerobong) {
                $cerobong_id = $cerobong->cerobong_id;
                $a['name' . $cerobong_id] = $cerobong->cerobong_name;
                $a['data' . $cerobong_id] = [];

                foreach ($timestamps as $t) {
                    $val = DB::table('data')
                        ->where('parameter', $parameter)
                        ->where('cerobong_id', $cerobong_id)
                        ->where('waktu', $t)
                        ->first();
                    
                    if ($val) {
                        $a['data' . $cerobong_id][] = (float)($q == 'flow' ? $val->laju_alir : $val->value);
                    } else {
                        $a['data' . $cerobong_id][] = 0;
                    }
                }
                
                if (empty($a['data' . $cerobong_id])) {
                    $a['data' . $cerobong_id] = array_fill(0, count($a['waktu']) ?: 15, 0);
                }
            }

            if (empty($a['waktu'])) {
                $a['waktu'] = array_fill(0, 15, now()->timestamp * 1000);
            }

            $response[] = $a;
            return response()->json($response);
        }

        if ($cat == 'all') {
            $a = [];
            $activeParameters = DB::table('parameter')->where('parameter_status', 'active')->get();
            
            $timestamps = DB::table('data')
                ->where('cerobong_id', $q)
                ->select('waktu')
                ->distinct()
                ->orderBy('waktu', 'desc')
                ->limit(25)
                ->pluck('waktu')
                ->reverse()
                ->values();

            $a['waktu'] = $timestamps->map(function($t) {
                return CemsHelper::timestamp($t);
            })->toArray();

            if (empty($a['waktu'])) {
                $a['waktu'] = array_fill(0, 25, now()->timestamp * 1000);
            }

            foreach ($activeParameters as $parameterData) {
                $p_code = $parameterData->parameter_code;
                $a['name' . $parameterData->parameter_id] = $parameterData->parameter_name . ' ' . $parameterData->parameter_portion;
                $a['type' . $parameterData->parameter_id] = 'line';
                $a['data' . $parameterData->parameter_id] = [];

                if ($timestamps->isEmpty()) {
                    $a['data' . $parameterData->parameter_id] = array_fill(0, 25, 0);
                } else {
                    foreach ($timestamps as $t) {
                        $val = DB::table('data')
                            ->where('parameter', $p_code)
                            ->where('cerobong_id', $q)
                            ->where('waktu', $t)
                            ->first();
                        $a['data' . $parameterData->parameter_id][] = $val ? (float)$val->value : 0;
                    }
                }
            }

            $a['nameflow'] = 'Flow m3/s';
            $a['typeflow'] = 'line';
            $a['dataflow'] = [];
            if ($timestamps->isEmpty()) {
                $a['dataflow'] = array_fill(0, 25, 0);
            } else {
                foreach ($timestamps as $t) {
                    $val = DB::table('data')
                        ->where('parameter', 'SO2')
                        ->where('cerobong_id', $q)
                        ->where('waktu', $t)
                        ->first();
                    $a['dataflow'][] = $val ? (float)$val->laju_alir : 0;
                }
            }

            $response[] = $a;
            return response()->json($response);
        }

        return response()->json([['waktu' => [], 'nameflow' => 'Flow', 'dataflow' => []]]);
    }
}
