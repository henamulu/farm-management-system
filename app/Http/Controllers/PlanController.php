<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Farm;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index(Request $request, Farm $farm)
    {
        $query = $farm->plans();

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by date
        if ($request->has('date_from') && $request->date_from !== '') {
            $query->whereDate('start_date', '>=', $request->date_from);
        }

        $plans = $query->latest()->paginate(10);

        return view('plans.index', compact('farm', 'plans'));
    }

    public function create(Farm $farm)
    {
        return view('plans.create', compact('farm'));
    }

    public function store(Request $request, Farm $farm)
    {
        $validated = $request->validate([
            'farm_item' => 'required|string',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'operation_price' => 'required|numeric|min:0'
        ]);

        $plan = $farm->plans()->create([
            ...$validated,
            'status' => 'draft'
        ]);

        if ($request->has('submit_and_new')) {
            return redirect()->route('farms.plans.create', $farm)
                ->with('success', 'Plan created successfully.');
        }

        return redirect()->route('farms.plans.index', $farm)
            ->with('success', 'Plan created successfully.');
    }

    public function edit(Farm $farm, Plan $plan)
    {
        return view('plans.edit', compact('farm', 'plan'));
    }

    public function update(Request $request, Farm $farm, Plan $plan)
    {
        $validated = $request->validate([
            'farm_item' => 'required|string',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'operation_price' => 'required|numeric|min:0'
        ]);

        $plan->update($validated);

        return redirect()->route('farms.plans.index', $farm)
            ->with('success', 'Plan updated successfully.');
    }

    public function approve(Plan $plan)
    {
        if ($plan->status !== 'draft') {
            return back()->with('error', 'Only draft plans can be approved.');
        }

        $plan->update(['status' => 'approved']);

        return back()->with('success', 'Plan approved successfully.');
    }

    public function destroy(Farm $farm, Plan $plan)
    {
        if ($plan->status !== 'draft') {
            return back()->with('error', 'Only draft plans can be deleted.');
        }

        $plan->delete();

        return back()->with('success', 'Plan deleted successfully.');
    }
} 