<?php

namespace App\Http\Controllers;

use App\Models\Observation;
use App\Models\Farmer;
use Illuminate\Http\Request;

class ObservationController extends Controller
{
    public function index()
    {
        $observations = Observation::with('crop.plot.farmer')->latest()->get();
        return view('observations.index', compact('observations'));
    }

    public function create()
    {
        $farmers = Farmer::with('plots.crops')->get();
        return view('observations.create', compact('farmers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'crop_id' => 'required|exists:crops,id',
            'observation_date' => 'required|date',
            'observation' => 'required|string',
        ]);

        Observation::create($validated);

        return redirect()->route('observations.index')->with('success', 'Observation logged successfully.');
    }

    public function edit(Observation $observation)
    {
        $farmers = Farmer::with('plots.crops')->get();
        return view('observations.edit', compact('observation', 'farmers'));
    }

    public function update(Request $request, Observation $observation)
    {
        $validated = $request->validate([
            'crop_id' => 'required|exists:crops,id',
            'observation_date' => 'required|date',
            'observation' => 'required|string',
        ]);

        $observation->update($validated);

        return redirect()->route('observations.index')->with('success', 'Observation updated successfully.');
    }

    public function destroy(Observation $observation)
    {
        $observation->delete();
        return redirect()->route('observations.index')->with('success', 'Observation deleted successfully.');
    }
}
