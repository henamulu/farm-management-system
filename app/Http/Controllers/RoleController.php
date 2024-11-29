<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:roles',
            'description' => 'required|string',
            'permissions' => 'required|array'
        ]);

        $role = Role::create($validated);

        return response()->json([
            'message' => 'Rol creado exitosamente',
            'data' => $role
        ]);
    }

    public function assignRole(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id'
        ]);

        $user = User::find($validated['user_id']);
        $user->role_id = $validated['role_id'];
        $user->save();

        return response()->json([
            'message' => 'Rol asignado exitosamente'
        ]);
    }
} 