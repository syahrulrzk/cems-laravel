<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use App\Models\Cerobong;
use Illuminate\Http\Request;

class ParameterController extends Controller
{
    public function index()
    {
        return view('parameter.index');
    }

    public function data(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search')['value'];

        $query = Parameter::query();

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('parameter_code', 'like', "%$search%")
                  ->orWhere('parameter_name', 'like', "%$search%");
            });
        }

        $totalRecords = Parameter::count();
        $filteredRecords = $query->count();

        $data = $query->orderBy('parameter_id', 'desc')
                      ->offset($start)
                      ->limit($length)
                      ->get();

        $formattedData = [];
        foreach ($data as $index => $param) {
            $formattedData[] = [
                $param->parameter_id,
                $param->parameter_code,
                $param->parameter_name,
                $param->parameter_threshold,
                $param->parameter_portion,
                $param->parameter_color,
                $param->parameter_status,
                $param->parameter_id  // For action buttons
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
        $parameter = null;
        $cerobongs = Cerobong::all();

        if ($id) {
            $parameter = Parameter::find($id);
        }

        return view('parameter.fetch', compact('action', 'parameter', 'id', 'cerobongs'));
    }

    public function post(Request $request)
    {
        $action = $request->action;
        
        if ($action == 'create') {
            Parameter::create([
                'cerobong_id' => $request->cerobong_id,
                'parameter_code' => $request->parameter_code,
                'parameter_name' => $request->parameter_name,
                'parameter_threshold' => $request->parameter_threshold,
                'parameter_portion' => $request->parameter_portion,
                'parameter_color' => $request->parameter_color,
                'parameter_status' => $request->parameter_status,
                'parameter_sispek' => $request->parameter_sispek,
            ]);
            return response('Parameter berhasil ditambahkan');
        }

        if ($action == 'update') {
            $param = Parameter::find($request->id);
            $param->update([
                'cerobong_id' => $request->cerobong_id,
                'parameter_code' => $request->parameter_code,
                'parameter_name' => $request->parameter_name,
                'parameter_threshold' => $request->parameter_threshold,
                'parameter_portion' => $request->parameter_portion,
                'parameter_color' => $request->parameter_color,
                'parameter_status' => $request->parameter_status,
                'parameter_sispek' => $request->parameter_sispek,
            ]);
            return response('Parameter berhasil diubah');
        }

        if ($action == 'delete') {
            Parameter::destroy($request->id);
            return response('Parameter berhasil dihapus');
        }

        return response('Action not found', 400);
    }
}
