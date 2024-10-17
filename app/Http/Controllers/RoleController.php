<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //neww


    public function index()
    {
        // Fetch all roles
           // Fetch all roles
           $roles = Role::all();

           // Pass roles to a view or return as JSON
           return view('roles.list',compact('roles'));
           // OR: return response()->json($roles);
    }
    // public function list()
    // {
    //     // Fetch all roles
    //     $roles = Role::all();

    //     // Pass roles to a view or return as JSON
    //     return view('roles.list',compact('roles'));
    //     // OR: return response()->json($roles);
    // }
    public function create()
    {
        $permissions = Permission::all();

        // Pass permissions to the view
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name', // Validate role name
          
        ]);
     

        // Create a new role
        $role = Role::create(['name' => $request->name]);

        // Sync permissions with the newly created role
        if ($request->has('permissions')) {
        
            $role->syncPermissions($request->permissions);
        }
     

        // Redirect back with a success message
        return redirect()->route('roles.index')->with('success', 'Role created successfully!');
    }
    public function edit($id)
    {
        // Fetch the role by ID
        $role = Role::findOrFail($id);


    

        // Fetch all permission
        $permissions = Permission::all();

        // Pass the role and permissions to the edit view
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
   
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        // Find the role and update its details
        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->permissions()->sync($request->input('permissions', [])); // Sync permissions

        // Save the role
        $role->save();

        // Redirect with a success message
        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }
    public function destroy($id)
{
    // Find the role by id
    $role = Role::findOrFail($id);

    // Delete the role
    $role->delete();

    // Redirect to the roles list with a success message
    return redirect()->route('roles.index')
                     ->with('success', 'Role deleted successfully');
}


    
   
}