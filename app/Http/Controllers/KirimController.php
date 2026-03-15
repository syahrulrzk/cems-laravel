<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class KirimController extends Controller
{
    public function index()
    {
        return view('kirim.index');
    }

    public function getStatus()
    {
        $config = Config::where('config_name', 'isKirim')->first();
        return response()->json(['isKirim' => $config ? $config->config_value : '0']);
    }

    public function updateStatus(Request $request)
    {
        $iskirim = $request->iskirim;
        Config::updateOrCreate(
            ['config_name' => 'isKirim'],
            ['config_value' => $iskirim]
        );
        return response()->json(['status' => 'sukses']);
    }

    public function manualSubmit(Request $request)
    {
        $datetime = $request->query('datetime');
        // TODO: Implement logic from klhkmanual.php
        return response()->json(['message' => 'Manual submit for ' . $datetime . ' is triggered (logic migration pending)']);
    }
}
