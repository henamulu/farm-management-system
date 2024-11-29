<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with('farm')->get();
        return response()->json(['data' => $stocks]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string',
            'category' => 'required|string',
            'quantity' => 'required|numeric',
            'unit' => 'required|string',
            'minimum_threshold' => 'required|numeric',
            'farm_id' => 'required|exists:farms,id'
        ]);

        $stock = Stock::create($validated);
        return response()->json(['message' => 'Stock creado exitosamente', 'data' => $stock], 201);
    }
} 