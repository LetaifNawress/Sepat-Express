<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Get the list of roles
    public function getRoles()
    {
        $roles = Role::all();

        return response()->json(['roles' => $roles]);
    }

    // Get the list of users with their roles
    public function getUsers()
    {
        $users = User::with('role')->get();

        return response()->json(['users' => $users]);
    }

    // Roles CRUD methods
    public function storeRole(Request $request)
    {
        try {
            $request->validate([
                'role' => 'required|unique:roles|max:255',
            ]);

            Role::create(['role' => $request->role]);

            return response()->json(['message' => 'Role created successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create role', 'details' => $e->getMessage()], 500);
        }
    }

    public function updateRole(Request $request, Role $role)
    {
        try {
            $request->validate([
                'name' => 'required|unique:roles,name,' . $role->id . '|max:255',
            ]);

            $role->update(['name' => $request->name]);

            return response()->json(['message' => 'Role updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update role', 'details' => $e->getMessage()], 500);
        }
    }

    public function destroyRole(Role $role)
    {
        try {
            $role->delete();

            return response()->json(['message' => 'Role deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete role', 'details' => $e->getMessage()], 500);
        }
    }

  // Users CRUD methods
  
  public function storeUser(Request $request)
  {
      $request->validate([
          'name' => 'required|max:255',
          'email' => 'required|email|unique:users',
          'password' => 'required|min:8',
          'role_id' => 'required|exists:roles,id',
      ]);
  
      try {
          DB::beginTransaction();
  
          $user = User::create([
              'name' => $request->input('name'),
              'email' => $request->input('email'),
              'password' => Hash::make($request->input('password')),
              'role_id' => $request->input('role_id'),
          ]);
  
          DB::commit();
  
          return response()->json(['message' => 'User created successfully']);
      } catch (\Exception $e) {
          DB::rollBack();
  
          return response()->json(['error' => 'Failed to create user', 'details' => $e->getMessage()], 500);
      }
  }
  
  public function updateUser(Request $request, User $user)
  {
      $request->validate([
          'name' => 'required|max:255',
          'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
          'role_id' => 'required|exists:roles,id',
      ]);
  
      try {
          DB::beginTransaction();
  
          $user->update([
              'name' => $request->input('name'),
              'email' => $request->input('email'),
              'role_id' => $request->input('role_id'),
          ]);
  
          DB::commit();
  
          return response()->json(['message' => 'User updated successfully']);
      } catch (\Exception $e) {
          DB::rollBack();
  
          return response()->json(['error' => 'Failed to update user', 'details' => $e->getMessage()], 500);
      }
  }
}