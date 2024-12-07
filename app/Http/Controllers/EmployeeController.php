<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Farm;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request, Farm $farm)
    {
        $query = $farm->employees();
    
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('position', 'like', "%{$search}%");
            });
        }
    
        if ($request->has('position') && $request->position !== '') {
            $query->where('position', $request->position);
        }
    
        $employees = $query->paginate(10); // Changed from get() to paginate()
        
        return view('employees.index', compact('farm', 'employees'));
    }

    public function create(Farm $farm)
    {
        return view('employees.create', compact('farm'));
    }

    public function store(Request $request, Farm $farm)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'salary' => 'required|numeric|min:0',
            'hire_date' => 'required|date',
        ]);

        $employee = $farm->employees()->create($validated);
        
        return redirect()->route('farms.employees.index', $farm)
            ->with('success', 'Employee registered successfully.');
    }

    public function edit(Farm $farm, Employee $employee)
    {
        return view('employees.edit', compact('farm', 'employee'));
    }

    public function update(Request $request, Farm $farm, Employee $employee)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'salary' => 'required|numeric|min:0',
            'hire_date' => 'required|date',
        ]);

        $employee->update($validated);
        
        return redirect()->route('farms.employees.index', $farm)
            ->with('success', 'Employee updated successfully.');
    }

    public function destroy(Farm $farm, Employee $employee)
    {
        $employee->delete();
        
        return redirect()->route('farms.employees.index', $farm)
            ->with('success', 'Employee deleted successfully.');
    }
} 