<?php

use App\Http\Controllers\CerobongController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KirimController;
use App\Http\Controllers\LogKirimDataController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/data', [DashboardController::class, 'getData'])->name('dashboard.data');
    Route::get('/dashboard/mini_alert', [DashboardController::class, 'miniAlert'])->name('dashboard.mini_alert');
    Route::get('/dashboard/mini_info', [DashboardController::class, 'miniInfo'])->name('dashboard.mini_info');
    
    Route::get('/cerobong/{id}', [CerobongController::class, 'show'])->name('cerobong.show');
    Route::get('/cerobong/{id}/data', [CerobongController::class, 'getData'])->name('cerobong.data');
    Route::get('/cerobong/{id}/status', [CerobongController::class, 'getStatus'])->name('cerobong.status');
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    
    Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance');
    Route::get('/maintenance/data', [MaintenanceController::class, 'data'])->name('maintenance.data');
    Route::post('/maintenance/fetch', [MaintenanceController::class, 'fetch'])->name('maintenance.fetch');
    Route::post('/maintenance/post', [MaintenanceController::class, 'post'])->name('maintenance.post');

    Route::get('/activity', [ActivityController::class, 'index'])->name('activity');
    Route::get('/activity/data', [ActivityController::class, 'data'])->name('activity.data');
    Route::post('/activity/fetch', [ActivityController::class, 'fetch'])->name('activity.fetch');
    Route::post('/activity/post', [ActivityController::class, 'post'])->name('activity.post');

    Route::get('/csv', [CsvController::class, 'index'])->name('csv');
    Route::post('/csv/upload', [CsvController::class, 'upload'])->name('csv.upload');

    Route::get('/kirim', [KirimController::class, 'index'])->name('kirim');
    Route::get('/kirim/status', [KirimController::class, 'getStatus'])->name('kirim.status');
    Route::post('/kirim/update', [KirimController::class, 'updateStatus'])->name('kirim.update');
    Route::get('/kirim/manual', [KirimController::class, 'manualSubmit'])->name('kirim.manual');
    
    Route::get('/logkirimdata', [LogKirimDataController::class, 'index'])->name('logkirimdata');
    Route::get('/logkirimdata/json', [LogKirimDataController::class, 'json'])->name('logkirimdata.json');
    Route::post('/logkirimdata/fetch', [LogKirimDataController::class, 'fetch'])->name('logkirimdata.fetch');
    
    Route::get('/notif', [NotificationController::class, 'index'])->name('notif');
    Route::get('/notif/data', [NotificationController::class, 'data'])->name('notif.data');
    Route::get('/notif/header', [NotificationController::class, 'header'])->name('notif.header');

    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/data', [UserController::class, 'data'])->name('user.data');
    Route::post('/user/fetch', [UserController::class, 'fetch'])->name('user.fetch');
    Route::post('/user/post', [UserController::class, 'post'])->name('user.post');
    
    Route::get('/parameter', [ParameterController::class, 'index'])->name('parameter');
    Route::get('/parameter/data', [ParameterController::class, 'data'])->name('parameter.data');
    Route::post('/parameter/fetch', [ParameterController::class, 'fetch'])->name('parameter.fetch');
    Route::post('/parameter/post', [ParameterController::class, 'post'])->name('parameter.post');
    
    Route::get('/reportbydaterange', [ReportController::class, 'byDateRange'])->name('report.daterange');
    Route::post('/reportbydaterange/fetch', [ReportController::class, 'fetch'])->name('report.daterange.fetch');
    Route::get('/reportbydaterange/data', [ReportController::class, 'data'])->name('report.daterange.data');
    Route::get('/reportbydaterange/ssp', [ReportController::class, 'ssp'])->name('report.daterange.ssp');
    Route::post('/reportbydaterange/export', [ReportController::class, 'exportExcel'])->name('report.daterange.export');
    Route::post('/reportbydaterange/exportpdf', [ReportController::class, 'exportPdf'])->name('report.daterange.exportpdf');
    Route::get('/reportbydate', [ReportController::class, 'byDate'])->name('report.date');
    Route::get('/reportbymonth', [ReportController::class, 'byMonth'])->name('report.month');
    Route::get('/reportbyyear', [ReportController::class, 'byYear'])->name('report.year');
    
    Route::get('/myprofile', [MyProfileController::class, 'index'])->name('myprofile');
    Route::post('/myprofile/post', [MyProfileController::class, 'post'])->name('myprofile.post');
    Route::get('/setting', [SettingController::class, 'index'])->name('setting');
    Route::post('/setting/post', [SettingController::class, 'post'])->name('setting.post');
    Route::post('/setting/upload', [SettingController::class, 'upload'])->name('setting.upload');
});
