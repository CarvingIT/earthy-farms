<?php

namespace App\Http\Controllers;

use App\Models\SoilReport;
use App\Models\Farmer;
use Illuminate\Http\Request;

class SoilReportController extends Controller
{
    public function index()
    {
        $reports = SoilReport::with('crop.plot.farmer')->latest()->get();
        return view('soil_reports.index', compact('reports'));
    }

    public function create()
    {
        $farmers = Farmer::with('plots.crops')->get();
        return view('soil_reports.create', compact('farmers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'crop_id' => 'required|exists:crops,id',
            'sample_date' => 'required|date',
            'Ph' => 'required|numeric|min:0|max:14',
            'EC' => 'required|numeric|min:0',
            'OC' => 'required|numeric|min:0',
            'N' => 'required|numeric|min:0',
            'P' => 'required|numeric|min:0',
            'K' => 'required|numeric|min:0',
            'Boron' => 'required|numeric|min:0',
            'Fe' => 'required|numeric|min:0',
            'Zn' => 'required|numeric|min:0',
            'Cu' => 'required|numeric|min:0',
            'Mg' => 'required|numeric|min:0',
            'S' => 'required|numeric|min:0',
            'microbial_count' => 'required|numeric|min:0',
        ]);

        SoilReport::create($validated);

        return redirect()->route('soil-reports.index')->with('success', 'Soil Report created successfully.');
    }

    public function edit(SoilReport $soilReport)
    {
        $farmers = Farmer::with('plots.crops')->get();
        return view('soil_reports.edit', compact('soilReport', 'farmers'));
    }

    public function update(Request $request, SoilReport $soilReport)
    {
        $validated = $request->validate([
            'crop_id' => 'required|exists:crops,id',
            'sample_date' => 'required|date',
            'Ph' => 'required|numeric|min:0|max:14',
            'EC' => 'required|numeric|min:0',
            'OC' => 'required|numeric|min:0',
            'N' => 'required|numeric|min:0',
            'P' => 'required|numeric|min:0',
            'K' => 'required|numeric|min:0',
            'Boron' => 'required|numeric|min:0',
            'Fe' => 'required|numeric|min:0',
            'Zn' => 'required|numeric|min:0',
            'Cu' => 'required|numeric|min:0',
            'Mg' => 'required|numeric|min:0',
            'S' => 'required|numeric|min:0',
            'microbial_count' => 'required|numeric|min:0',
        ]);

        $soilReport->update($validated);

        return redirect()->route('soil-reports.index')->with('success', 'Soil Report updated successfully.');
    }

    public function destroy(SoilReport $soilReport)
    {
        $soilReport->delete();
        return redirect()->route('soil-reports.index')->with('success', 'Soil Report deleted successfully.');
    }
}
