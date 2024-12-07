<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use App\Models\Machinery;
use Illuminate\Http\Request;

class MachineryController extends Controller
{
    public function index(Request $request, Farm $farm)
    {
        $query = $farm->machinery();

        // Search by name or type
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by maintenance due
        if ($request->has('maintenance') && $request->maintenance === 'due') {
            $query->where('next_maintenance', '<=', now()->addDays(7));
        }

        $machinery = $query->orderBy('name')->paginate(10);

        return view('machinery.index', [
            'farm' => $farm,
            'machinery' => $machinery,
            'search' => $request->search,
            'status' => $request->status,
            'maintenance' => $request->maintenance
        ]);
    }

    public function create(Farm $farm)
    {
        return view('machinery.create', compact('farm'));
    }

    public function store(Request $request, Farm $farm)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'status' => 'required|in:operational,maintenance,repair,retired',
            'last_maintenance' => 'nullable|date',
            'next_maintenance' => 'nullable|date|after:last_maintenance',
            'purchase_date' => 'required|date',
            'purchase_price' => 'required|numeric|min:0'
        ]);

        $machinery = $farm->machinery()->create($validated);

        return redirect()->route('farms.show', $farm)
            ->with('success', 'Machine added successfully.');
    }

    public function edit(Farm $farm, Machinery $machinery)
    {
        return view('machinery.edit', compact('farm', 'machinery'));
    }

    public function update(Request $request, Farm $farm, Machinery $machinery)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'status' => 'required|in:operational,maintenance,repair,retired',
            'last_maintenance' => 'nullable|date',
            'next_maintenance' => 'nullable|date|after:last_maintenance',
            'purchase_date' => 'required|date',
            'purchase_price' => 'required|numeric|min:0'
        ]);

        $machinery->update($validated);

        return redirect()->route('farms.show', $farm)
            ->with('success', 'Machine updated successfully.');
    }

    public function destroy(Farm $farm, Machinery $machinery)
    {
        $machinery->delete();

        return redirect()->route('farms.show', $farm)
            ->with('success', 'Machine deleted successfully.');
    }
} 