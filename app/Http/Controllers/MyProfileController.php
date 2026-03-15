<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MyProfileController extends Controller
{
    public function index()
    {
        return view('myprofile.index');
    }

    public function post(Request $request)
    {
        $user = auth()->user();
        
        $data = [
            'name' => $request->user_full,
        ];

        if ($request->filled('user_pass')) {
            $data['password'] = Hash::make($request->user_pass);
        }

        $user->update($data);

        return response('Data has been updated');
    }
}
