<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Admin\AdminBaseController;


class UsersController extends AdminBaseController
{
    public function index()
    {
        return Inertia::render('Users/Index', [
            'filters' => Request::all('search', 'role', 'trashed'),
            'users' => User::filter(Request::only('search', 'role', 'trashed'))
                ->get()
                ->transform(fn ($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->getRoleNames()->first(),
                    'deleted_at' => $user->deleted_at,
                ]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store()
    {
        Request::validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')],
            'role' => ['required'],
        ]);

        $user = User::create([
            'name' => Request::get('name'),
            'email' => Request::get('email'),
        ]);
        $user->assignRole(Request::get('role'));


        return Redirect::route('users')->with('success', 'User created.');
    }

    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->getRoleNames()->first(),
                'deleted_at' => $user->deleted_at,
            ],
        ]);
    }

    public function update(User $user)
    {


        Request::validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($user->id)],
            'role' => ['required'],
        ]);

        $user->roles()->detach();
        $user->assignRole(Request::get('role'));
        $user->update(Request::only('name', 'email'));

        return Redirect::back()->with('success', 'User updated.');
    }

    public function destroy(User $user)
    {
        if ($user->isAdmin()) {
            return Redirect::back()->with('error', 'Deleting the Admin user is not allowed.');
        }
        $user->delete();

        return Redirect::back()->with('success', 'User deleted.');
    }

    public function restore(User $user)
    {
        $user->restore();

        return Redirect::back()->with('success', 'User restored.');
    }
}
