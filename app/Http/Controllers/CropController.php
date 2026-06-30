<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\Farmer;
use Illuminate\Http\Request;

class CropController extends Controller
{
    public function index()
    {
        $crops = Crop::with('plot.farmer')->latest()->get();
        return view('crops.index', compact('crops'));
    }

    public function create()
    {
        $farmers = Farmer::with('plots')->get();
        return view('crops.create', compact('farmers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'plot_id' => 'required|exists:plots,id',
            'name' => 'required|string|max:255',
            'variety' => 'required|string|max:255',
            'sowing_date' => 'required|date',
            'harvest_date' => 'required|date|after_or_equal:sowing_date',
        ]);

        Crop::create($validated);

        return redirect()->route('crops.index')->with('success', 'Crop planted successfully.');
    }

    public function edit(Crop $crop)
    {
        $farmers = Farmer::with('plots')->get();
        return view('crops.edit', compact('crop', 'farmers'));
    }

    public function update(Request $request, Crop $crop)
    {
        $validated = $request->validate([
            'plot_id' => 'required|exists:plots,id',
            'name' => 'required|string|max:255',
            'variety' => 'required|string|max:255',
            'sowing_date' => 'required|date',
            'harvest_date' => 'required|date|after_or_equal:sowing_date',
        ]);

        $crop->update($validated);

        return redirect()->route('crops.index')->with('success', 'Crop updated successfully.');
    }

    public function destroy(Crop $crop)
    {
        $crop->delete();
        return redirect()->route('crops.index')->with('success', 'Crop deleted successfully.');
    }
}
