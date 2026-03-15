<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function apiIndex(Request $request)
    {
        $limit = $request->input('limit', 100);
        $data = Data::with('cerobong')
            ->orderByDesc('waktu')
            ->limit($limit)
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function apiByCerobong(Request $request, $cerobong_id)
    {
        $limit = $request->input('limit', 100);
        $data = Data::where('cerobong_id', $cerobong_id)
            ->orderByDesc('waktu')
            ->limit($limit)
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
