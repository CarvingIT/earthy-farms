<?php

namespace App\Http\Controllers;

use App\Models\Input;
use Illuminate\Http\Request;

class InputController extends Controller
{
    public function index()
    {
        $inputs = Input::latest()->get();
        return view('inputs.index', compact('inputs'));
    }

    public function create()
    {
        return view('inputs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
        ]);

        Input::create($validated);

        return redirect()->route('inputs.index')->with('success', 'Input created successfully.');
    }

    public function edit(Input $input)
    {
        return view('inputs.edit', compact('input'));
    }

    public function update(Request $request, Input $input)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
        ]);

        $input->update($validated);

        return redirect()->route('inputs.index')->with('success', 'Input updated successfully.');
    }

    public function destroy(Input $input)
    {
        $input->delete();
        return redirect()->route('inputs.index')->with('success', 'Input deleted successfully.');
    }
}
