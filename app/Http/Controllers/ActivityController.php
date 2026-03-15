<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function index()
    {
        return view('activity.index');
    }

    public function data(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search')['value'];
        $cat = $request->get('cat', 'all');

        $query = Activity::query();

        if ($cat != 'all') {
            if (in_array($cat, ['troubleshoot', 'service', 'maintenance'])) {
                $query->where('activity_cat', $cat);
            } else {
                $query->where('activity_status', $cat);
            }
        }

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('activity_title', 'like', "%$search%")
                  ->orWhere('activity_desc', 'like', "%$search%");
            });
        }

        $totalRecords = Activity::count();
        $filteredRecords = $query->count();

        $data = $query->orderBy('activity_id', 'desc')
                      ->offset($start)
                      ->limit($length)
                      ->get();

        $formattedData = [];
        foreach ($data as $index => $item) {
            $formattedData[] = [
                $index + $start + 1,
                $item->activity_title,
                $item->activity_cat,
                $item->activity_desc,
                $item->activity_from . ' - ' . $item->activity_to,
                $item->activity_id  // For action buttons
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
        $activity = Activity::find($id);

        return view('activity.fetch', compact('action', 'activity', 'id'));
    }

    public function post(Request $request)
    {
        $action = $request->action;
        
        if ($action == 'create') {
            Activity::create([
                'activity_title' => $request->activity_title,
                'activity_cat' => $request->activity_cat,
                'activity_desc' => $request->activity_desc,
                'activity_status' => 'star',
                'activity_from' => $request->activity_from,
                'activity_to' => $request->activity_to,
            ]);
            return response('Activity berhasil ditambahkan');
        }

        if ($action == 'update') {
            $activity = Activity::find($request->id);
            $activity->update([
                'activity_title' => $request->activity_title,
                'activity_cat' => $request->activity_cat,
                'activity_desc' => $request->activity_desc,
                'activity_from' => $request->activity_from,
                'activity_to' => $request->activity_to,
            ]);
            return response('Activity berhasil diubah');
        }

        if ($action == 'delete') {
            Activity::destroy($request->id);
            return response('Activity berhasil dihapus');
        }

        return response('Action not found', 400);
    }
}
