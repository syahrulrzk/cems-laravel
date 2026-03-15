<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $fdate = now()->subDays(91)->toDateTimeString();
        $tdate = now()->subDay()->toDateTimeString();

        $valid = Data::where('status', 'valid')
            ->whereBetween('waktu', [$fdate, $tdate])
            ->count();

        $total = Data::whereBetween('waktu', [$fdate, $tdate])
            ->count();

        $result = $total > 0 ? ($valid / $total) * 100 : 0;

        if ($result >= 90) {
            $grade = 'A';
            $bg = 'bg-success';
        } elseif ($result >= 75) {
            $grade = 'B';
            $bg = 'bg-warning';
        } else {
            $grade = 'C';
            $bg = 'bg-danger';
        }

        return view('profile.index', compact('grade', 'bg'));
    }
}
