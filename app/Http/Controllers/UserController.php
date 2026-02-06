<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{

    private function getAllRoles()
    {
        return Role::orderBy('name')->get();
    }

    public function index()
    {
        $users = User::with('role')->orderBy('name')->get();
        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function create()
    {
        $roles = $this->getAllRoles();
        return view('users.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        $roles = $this->getAllRoles();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UserRequest $request, User $user)
    {
        $validatedData = $request->validated();
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }
        $user->update($validatedData);
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $authUser = auth()->user();

        if ($authUser->id === $user->id) {
            return redirect()->back()->with('error', 'You cannot delete your own user account.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }

}
