<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FinancialTransaction;
use App\Models\Budget;
use Illuminate\Http\Request;
use DB;

class FinancialController extends Controller
{
    public function recordTransaction(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string',
            'category' => 'required|string',
            'date' => 'required|date',
            'farm_id' => 'required|exists:farms,id',
            'crop_id' => 'nullable|exists:crops,id'
        ]);

        $transaction = FinancialTransaction::create(array_merge(
            $validated,
            ['created_by' => auth()->id()]
        ));

        // Actualizar presupuesto si existe
        if ($transaction->crop_id) {
            $this->updateBudgetActuals($transaction);
        }

        return response()->json([
            'message' => 'Transacción registrada exitosamente',
            'data' => $transaction
        ]);
    }

    public function getProfitabilityReport(Request $request)
    {
        $cropId = $request->input('crop_id');
        
        $income = FinancialTransaction::where('crop_id', $cropId)
            ->where('type', 'income')
            ->sum('amount');
            
        $expenses = FinancialTransaction::where('crop_id', $cropId)
            ->where('type', 'expense')
            ->sum('amount');
            
        $profit = $income - $expenses;
        
        return response()->json([
            'income' => $income,
            'expenses' => $expenses,
            'profit' => $profit,
            'roi' => $expenses > 0 ? ($profit / $expenses) * 100 : 0
        ]);
    }

    private function updateBudgetActuals(FinancialTransaction $transaction)
    {
        $budget = Budget::where('crop_id', $transaction->crop_id)
            ->where('category', $transaction->category)
            ->where('period_start', '<=', $transaction->date)
            ->where('period_end', '>=', $transaction->date)
            ->first();

        if ($budget) {
            $budget->actual_amount = DB::raw('actual_amount + ' . $transaction->amount);
            $budget->save();
        }
    }
} 