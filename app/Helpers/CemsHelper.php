<?php

namespace App\Helpers;

use App\Models\Config;

class CemsHelper
{
    public static function config($name)
    {
        $config = Config::where('config_name', $name)->first();
        return $config ? $config->config_value : null;
    }

    public static function company() { return self::config('company'); }
    public static function address() { return self::config('address'); }
    public static function country() { return self::config('country'); }
    public static function phone() { return self::config('phone'); }
    public static function lt() { return self::config('lt'); }
    public static function lg() { return self::config('lg'); }
    public static function logo() { return asset('upload/' . self::config('logo')); }
    public static function province() { return self::config('province'); }

    public static function province_name($id)
    {
        $province = \App\Models\Province::find($id);
        return $province ? $province->province_name : '';
    }

    public static function waktu($date)
    {
        return date('d M Y H:i:s', strtotime($date));
    }

    public static function tanggal($date)
    {
        return date('d M Y', strtotime($date));
    }

    public static function jam($date)
    {
        return date('H:i:s', strtotime($date));
    }

    public static function timestamp($date)
    {
        return strtotime($date) * 1000;
    }

    public static function singkat_angka($n, $presisi = 1)
    {
        if ($n < 900) {
            $format_angka = number_format($n, $presisi);
            $simbol = '';
        } else if ($n < 900000) {
            $format_angka = number_format($n / 1000, $presisi);
            $simbol = 'rb';
        } else if ($n < 900000000) {
            $format_angka = number_format($n / 1000000, $presisi);
            $simbol = 'jt';
        } else if ($n < 900000000000) {
            $format_angka = number_format($n / 1000000000, $presisi);
            $simbol = 'M';
        } else {
            $format_angka = number_format($n / 1000000000000, $presisi);
            $simbol = 'T';
        }
        if ($presisi > 0) {
            $pisah = '.' . str_repeat('0', $presisi);
            $format_angka = str_replace($pisah, '', $format_angka);
        }
        return $format_angka . $simbol;
    }
}
