<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\PlotController;
use App\Http\Controllers\CropController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\SoilReportController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\ObservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $stats = [
        'farmers' => \App\Models\Farmer::count(),
        'plots' => \App\Models\Plot::count(),
        'crops' => \App\Models\Crop::count(),
        'inputs' => \App\Models\Input::count(),
        'total_area' => \App\Models\Plot::sum('area') ?? 0,
        'recent_observations' => \App\Models\Observation::with('crop.plot.farmer')->latest()->take(4)->get(),
        'recent_soil_reports' => \App\Models\SoilReport::with('crop.plot.farmer')->latest()->take(4)->get(),
    ];
    return view('dashboard', compact('stats'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // User Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Agricultural Resources
    Route::resource('farmers', FarmerController::class);
    Route::resource('plots', PlotController::class);
    Route::resource('crops', CropController::class);
    Route::resource('inputs', InputController::class);
    Route::resource('soil-reports', SoilReportController::class);
    Route::resource('supplies', SupplyController::class);
    Route::resource('observations', ObservationController::class);
});

require __DIR__.'/auth.php';
