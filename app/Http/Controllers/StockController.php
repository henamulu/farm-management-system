<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Farm;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request, Farm $farm)
    {
        $query = $farm->stocks();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        if ($request->has('type') && $request->type !== '') {
            $query->where('type', $request->type);
        }

        $stocks = $query->paginate(10);
        
        return view('stocks.index', compact('farm', 'stocks'));
    }

    public function create(Farm $farm)
    {
        return view('stocks.create', compact('farm'));
    }

    public function store(Request $request, Farm $farm)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'price' => 'nullable|numeric|min:0',
        ]);

        $stock = $farm->stocks()->create($validated);
        
        return redirect()->route('farms.stocks.index', $farm)
            ->with('success', 'Stock agregado exitosamente.');
    }

    public function edit(Farm $farm, Stock $stock)
    {
        return view('stocks.edit', compact('farm', 'stock'));
    }

    public function update(Request $request, Farm $farm, Stock $stock)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'price' => 'nullable|numeric|min:0',
        ]);

        $stock->update($validated);
        
        return redirect()->route('farms.stocks.index', $farm)
            ->with('success', 'Stock actualizado exitosamente.');
    }

    public function destroy(Farm $farm, Stock $stock)
    {
        $stock->delete();
        
        return redirect()->route('farms.stocks.index', $farm)
            ->with('success', 'Stock eliminado exitosamente.');
    }
}