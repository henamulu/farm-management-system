<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Activity;
use App\Models\Stock;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    public function generateStockReport(Request $request)
    {
        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'period_start' => 'required|date',
            'period_end' => 'required|date|after:period_start'
        ]);

        // Get stock data
        $stockData = Stock::where('farm_id', $validated['farm_id'])
            ->whereBetween('created_at', [$validated['period_start'], $validated['period_end']])
            ->get()
            ->groupBy('category');

        // Create report
        $report = Report::create([
            'type' => 'stock',
            'period_start' => $validated['period_start'],
            'period_end' => $validated['period_end'],
            'farm_id' => $validated['farm_id'],
            'data' => $stockData,
            'generated_by' => auth()->id()
        ]);

        return response()->json([
            'message' => 'Report generated successfully',
            'data' => $report
        ]);
    }

    public function generateActivityReport(Request $request)
    {
        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'period_start' => 'required|date',
            'period_end' => 'required|date|after:period_start'
        ]);

        $activityData = Activity::where('farm_id', $validated['farm_id'])
            ->whereBetween('start_date', [$validated['period_start'], $validated['period_end']])
            ->with(['assignedUser'])
            ->get()
            ->groupBy('status');

        $report = Report::create([
            'type' => 'activity',
            'period_start' => $validated['period_start'],
            'period_end' => $validated['period_end'],
            'farm_id' => $validated['farm_id'],
            'data' => $activityData,
            'generated_by' => auth()->id()
        ]);

        return response()->json([
            'message' => 'Activity report generated successfully',
            'data' => $report
        ]);
    }

    public function downloadPDF(Report $report)
    {
        $pdf = PDF::loadView('reports.template', [
            'report' => $report
        ]);

        return $pdf->download("report_{$report->type}_{$report->id}.pdf");
    }
} 