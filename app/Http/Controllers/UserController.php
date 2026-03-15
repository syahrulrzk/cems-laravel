<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function data(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search')['value'];

        $query = User::query();

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('email', 'like', "%$search%")
                  ->orWhere('name', 'like', "%$search%")
                  ->orWhere('role', 'like', "%$search%");
            });
        }

        $totalRecords = User::count();
        $filteredRecords = $query->count();

        $data = $query->orderBy('id', 'desc')
                      ->offset($start)
                      ->limit($length)
                      ->get();

        $formattedData = [];
        foreach ($data as $index => $user) {
            $formattedData[] = [
                $user->id,
                $user->email,
                $user->id, // For password button
                $user->name,
                $user->role,
                $user->notif,
                $user->id  // For action buttons
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
        $user = null;

        if ($id) {
            $user = User::find($id);
        }

        return view('user.fetch', compact('action', 'user', 'id'));
    }

    public function post(Request $request)
    {
        $action = $request->action;
        
        if ($action == 'create') {
            User::create([
                'email' => $request->user_email,
                'password' => Hash::make($request->user_pass),
                'name' => $request->user_full,
                'role' => $request->user_role,
                'notif' => $request->user_notif,
            ]);
            return response('User berhasil ditambahkan');
        }

        if ($action == 'update') {
            $user = User::find($request->id);
            $user->update([
                'name' => $request->user_full,
                'role' => $request->user_role,
                'notif' => $request->user_notif,
            ]);
            return response('User berhasil diubah');
        }

        if ($action == 'delete') {
            User::destroy($request->id);
            return response('User berhasil dihapus');
        }

        if ($action == 'password') {
            $user = User::find($request->id);
            $user->update([
                'password' => Hash::make($request->user_pass),
            ]);
            return response('Password berhasil diubah');
        }

        return response('Action not found', 400);
    }
}
