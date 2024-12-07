<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use Illuminate\Http\Request;

class FarmController extends Controller
{
    public function index()
    {
        $farms = Farm::with('stocks')->get();
        return view('farms.index', compact('farms'));
    }

    public function create()
    {
        return view('farms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'size' => 'nullable|numeric|min:0',
        ]);

        $farm = auth()->user()->farms()->create($validated);
        
        return redirect()->route('farms.show', $farm)
            ->with('success', 'Granja creada exitosamente.');
    }

    public function show(Farm $farm)
    {
        return view('farms.show', compact('farm'));
    }

    public function edit(Farm $farm)
    {
        return view('farms.edit', compact('farm'));
    }

    public function update(Request $request, Farm $farm)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'size' => 'nullable|numeric|min:0',
        ]);

        $farm->update($validated);
        
        return redirect()->route('farms.show', $farm)
            ->with('success', 'Granja actualizada exitosamente.');
    }

    public function destroy(Farm $farm)
    {
        $farm->delete();
        
        return redirect()->route('farms.index')
            ->with('success', 'Granja eliminada exitosamente.');
    }
}