<?php

namespace App\Http\Controllers;

use App\Models\Observation;
use App\Models\Farmer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'photo' => 'nullable|image|max:10240',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo_path'] = $request->file('photo')->store('observations', 'public');
        }

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
            'photo' => 'nullable|image|max:10240',
        ]);

        if ($request->hasFile('photo')) {
            if ($observation->photo_path) {
                Storage::disk('public')->delete($observation->photo_path);
            }
            $validated['photo_path'] = $request->file('photo')->store('observations', 'public');
        }

        $observation->update($validated);

        return redirect()->route('observations.index')->with('success', 'Observation updated successfully.');
    }

    public function destroy(Observation $observation)
    {
        if ($observation->photo_path) {
            Storage::disk('public')->delete($observation->photo_path);
        }
        $observation->delete();
        return redirect()->route('observations.index')->with('success', 'Observation deleted successfully.');
    }
}
