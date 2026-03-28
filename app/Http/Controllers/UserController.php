<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('backend.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::get();
        return view('backend.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role_assign' => 'required|array',
            'role_assign.*' => 'exists:roles,id',
            'status' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status,
        ]);

        if ($request->role_assign) {
            $roles = Role::whereIn('id', $request->role_assign)->get();
            if (!$roles) {
                return null;
            }
            $user->assignRole($roles);
        }

        Alert::success('Success', 'User created successfully.');

        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get();

        return view('backend.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|email',
            'password' => 'nullable|min:8',
            'role_assign' => 'required|array',
            'role_assign.*' => 'exists:roles,id',
            'status' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->status = $request->status;
        $user->save();

        $user->roles()->detach();
        $roles = Role::whereIn('id', $request->role_assign)->get();
        if (!$roles) {
            return null;
        }
        $user->assignRole($roles);

        Alert::success('Success', 'User updated successfully.');

        return redirect()->route('users.index');
    }

    public function delete($id)
    {
        if ($id) {
            $user = User::find($id);

            if (!is_null($user)) {
                $user->delete();
                Alert::success('Success', 'User deleted successfully.');
            } else {
                Alert::error('Error', 'User not found.');
            }
        } else {
            Alert::error('Error', 'Invalid user ID.');
        }

        return redirect()->route('users.index');
    }
}
