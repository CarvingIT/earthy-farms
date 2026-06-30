<?php

namespace App\Http\Controllers;

use App\Models\Supply;
use App\Models\Farmer;
use App\Models\Input;
use Illuminate\Http\Request;

class SupplyController extends Controller
{
    public function index()
    {
        $supplies = Supply::with(['crop.plot.farmer', 'input'])->latest()->get();
        return view('supplies.index', compact('supplies'));
    }

    public function create()
    {
        $farmers = Farmer::with('plots.crops')->get();
        $inputs = Input::all();
        return view('supplies.create', compact('farmers', 'inputs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'crop_id' => 'required|exists:crops,id',
            'input_id' => 'required|exists:inputs,id',
            'quantity' => 'required|numeric|min:0.01',
            'loading_date' => 'required|date',
        ]);

        Supply::create($validated);

        return redirect()->route('supplies.index')->with('success', 'Supply recorded successfully.');
    }

    public function edit(Supply $supply)
    {
        $farmers = Farmer::with('plots.crops')->get();
        $inputs = Input::all();
        return view('supplies.edit', compact('supply', 'farmers', 'inputs'));
    }

    public function update(Request $request, Supply $supply)
    {
        $validated = $request->validate([
            'crop_id' => 'required|exists:crops,id',
            'input_id' => 'required|exists:inputs,id',
            'quantity' => 'required|numeric|min:0.01',
            'loading_date' => 'required|date',
        ]);

        $supply->update($validated);

        return redirect()->route('supplies.index')->with('success', 'Supply updated successfully.');
    }

    public function destroy(Supply $supply)
    {
        $supply->delete();
        return redirect()->route('supplies.index')->with('success', 'Supply deleted successfully.');
    }
}
