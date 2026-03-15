<?php

namespace App\Http\Controllers;

use App\Models\Cerobong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaintenanceController extends Controller
{
    public function index()
    {
        return view('maintenance.index');
    }

    public function data(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search')['value'];

        $query = Cerobong::query();

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('cerobong_name', 'like', "%$search%")
                  ->orWhere('cerobong_status', 'like', "%$search%");
            });
        }

        $totalRecords = Cerobong::count();
        $filteredRecords = $query->count();

        $data = $query->orderBy('cerobong_id', 'desc')
                      ->offset($start)
                      ->limit($length)
                      ->get();

        $formattedData = [];
        foreach ($data as $index => $item) {
            $formattedData[] = [
                $index + $start + 1,
                $item->cerobong_name,
                $item->cerobong_status,
                $item->cerobong_schedule,
                $item->cerobong_from,
                $item->cerobong_to,
                $item->cerobong_user,
                $item->cerobong_id  // For action buttons
            ];
        }

        return response()->json([
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $formattedData
        ]);
    }

    public function fetch(Request $request)
    {
        $action = $request->action;
        $id = $request->id;
        $cerobong = Cerobong::find($id);

        return view('maintenance.fetch', compact('action', 'cerobong', 'id'));
    }

    public function post(Request $request)
    {
        $action = $request->action;
        $cerobong = Cerobong::find($request->id);
        
        if ($action == 'update') {
            $cerobong->update([
                'cerobong_status' => $request->cerobong_status,
                'cerobong_schedule' => $request->cerobong_schedule,
                'cerobong_from' => $request->cerobong_from,
                'cerobong_to' => $request->cerobong_to,
                'cerobong_user' => auth()->user()->name,
            ]);
            return response('Maintenance berhasil diubah');
        }

        return response('Action not found', 400);
    }
}
