<?php

namespace App\Http\Controllers;

use App\Models\Plot;
use App\Models\Farmer;
use Illuminate\Http\Request;

class PlotController extends Controller
{
    public function index()
    {
        $plots = Plot::with('farmer')->latest()->get();
        return view('plots.index', compact('plots'));
    }

    public function create()
    {
        $farmers = Farmer::all();
        return view('plots.create', compact('farmers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'farmer_id' => 'required|exists:farmers,id',
            'name' => 'required|string|max:255',
            'area' => 'required|numeric|min:0.01',
        ]);

        Plot::create($validated);

        return redirect()->route('plots.index')->with('success', 'Plot created successfully.');
    }

    public function edit(Plot $plot)
    {
        $farmers = Farmer::all();
        return view('plots.edit', compact('plot', 'farmers'));
    }

    public function update(Request $request, Plot $plot)
    {
        $validated = $request->validate([
            'farmer_id' => 'required|exists:farmers,id',
            'name' => 'required|string|max:255',
            'area' => 'required|numeric|min:0.01',
        ]);

        $plot->update($validated);

        return redirect()->route('plots.index')->with('success', 'Plot updated successfully.');
    }

    public function destroy(Plot $plot)
    {
        $plot->delete();
        return redirect()->route('plots.index')->with('success', 'Plot deleted successfully.');
    }
}
