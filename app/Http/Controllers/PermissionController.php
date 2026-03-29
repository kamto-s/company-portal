<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::get()->sortBy('name');
        return view('backend.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('backend.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
            'guard_name' => 'required|in:web,api',
            'group_name' => 'required',
        ]);

        Permission::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
            'group_name' => $request->group_name,
        ]);

        Alert::success('Success', 'Permission created successfully.');

        return redirect()->route('permissions.index');
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('backend.permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
            'guard_name' => 'required|in:web,api',
            'group_name' => 'required',
        ]);

        $permission->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
            'group_name' => $request->group_name,
        ]);

        Alert::success('Success', 'Permission updated successfully.');

        return redirect()->route('permissions.index');
    }

    public function delete($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        Alert::success('Success', 'Permission deleted successfully.');

        return redirect()->route('permissions.index');
    }
}
