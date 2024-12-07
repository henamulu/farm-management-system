<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $farms = $user->farms;
        
        // Get the first farm or null if no farms exist
        $currentFarm = $farms->first();

        // Get total employees across all farms
        $totalEmployees = Employee::whereIn('farm_id', $farms->pluck('id'))->count();

        // Get recent employees
        $recentEmployees = Employee::whereIn('farm_id', $farms->pluck('id'))
            ->latest('hire_date')
            ->take(3)
            ->get();

        // Get employees by position
        $employeesByPosition = Employee::whereIn('farm_id', $farms->pluck('id'))
            ->select('position', DB::raw('count(*) as total'))
            ->groupBy('position')
            ->pluck('total', 'position')
            ->toArray();

        return view('dashboard', compact(
            'farms',
            'currentFarm',
            'totalEmployees',
            'recentEmployees',
            'employeesByPosition'
        ));
    }
} 