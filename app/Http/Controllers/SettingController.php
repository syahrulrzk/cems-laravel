<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Province;
use App\Models\Parameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function index()
    {
        $provinces = Province::all();
        $parameters = Parameter::all();
        return view('setting.index', compact('provinces', 'parameters'));
    }

    public function post(Request $request)
    {
        if ($request->has('company')) {
            Config::where('config_name', 'company')->update(['config_value' => $request->company ?? '']);
        }
        if ($request->has('province')) {
            Config::where('config_name', 'province')->update(['config_value' => $request->province ?? '']);
        }
        if ($request->has('phone')) {
            Config::where('config_name', 'phone')->update(['config_value' => $request->phone ?? '']);
        }
        if ($request->has('client_id')) {
            Config::where('config_name', 'client_id')->update(['config_value' => $request->client_id ?? '']);
        }
        if ($request->has('secret_id')) {
            Config::where('config_name', 'secret_id')->update(['config_value' => $request->secret_id ?? '']);
        }
        if ($request->has('address')) {
            Config::where('config_name', 'address')->update(['config_value' => $request->address ?? '']);
        }
        if ($request->has('telegram')) {
            Config::where('config_name', 'telegram')->update(['config_value' => $request->telegram ?? '']);
        }
        if ($request->has('telegram_chat_id')) {
            Config::where('config_name', 'telegram_chat_id')->update(['config_value' => $request->telegram_chat_id ?? '']);
        }

        // Handle active parameters
        Parameter::query()->update(['parameter_status' => '']);
        if ($request->has('parameter_code')) {
            foreach ($request->parameter_code as $code) {
                Parameter::where('parameter_code', $code)->update(['parameter_status' => 'active']);
            }
        }

        return response('Data has been updated');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('logo')) {
            // Delete old logo
            $uploadPath = public_path('upload');
            if (File::exists($uploadPath)) {
                File::cleanDirectory($uploadPath);
            } else {
                File::makeDirectory($uploadPath, 0755, true);
            }

            $file = $request->file('logo');
            $fileName = $file->getClientOriginalName();
            $file->move($uploadPath, $fileName);

            Config::where('config_name', 'logo')->update(['config_value' => $fileName]);

            return response()->json([
                'success' => true,
                'logo_url' => asset('upload/' . $fileName)
            ]);
        }

        return response()->json(['success' => false], 400);
    }
}
