<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use App\Models\Ticket;
use App\Models\JotForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Admin\AdminBaseController;

class TicketsController extends AdminBaseController
{
    public function index()
    {
        return Inertia::render('Tickets/Index', [
            'tickets' => Ticket::where('user_id', auth()->user()->id)
                ->get()
                ->transform(fn($ticket) => [
                    'id' => $ticket->id,
                    'created_at' => $ticket->created_at,
                ]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Tickets/Create', [
            'form' => JotForm::form(),
        ]);
    }

    public function show($id)
    {
        return Inertia::render('Tickets/Show', [
            'ticket' => Ticket::find($id)
        ]);
    }

    public function download($id)
    {
        $qrCode = Ticket::find($id)->qr_path;
        return Response::download($qrCode);

    }
    // public function store()
    // {
    //     Request::validate([
    //         'name' => ['required', 'max:50'],
    //         'email' => ['required', 'max:50', 'email', Rule::unique('users')],
    //         'role' => ['required'],
    //     ]);

    //     $user = User::create([
    //         'name' => Request::get('name'),
    //         'email' => Request::get('email'),
    //     ]);
    //     $user->assignRole(Request::get('role'));


    //     return Redirect::route('users')->with('success', 'User created.');
    // }

    // public function edit(User $user)
    // {
    //     return Inertia::render('Users/Edit', [
    //         'user' => [
    //             'id' => $user->id,
    //             'name' => $user->name,
    //             'email' => $user->email,
    //             'role' => $user->getRoleNames()->first(),
    //             'deleted_at' => $user->deleted_at,
    //         ],
    //     ]);
    // }

    // public function update(User $user)
    // {


    //     Request::validate([
    //         'name' => ['required', 'max:50'],
    //         'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($user->id)],
    //         'role' => ['required'],
    //     ]);

    //     $user->roles()->detach();
    //     $user->assignRole(Request::get('role'));
    //     $user->update(Request::only('name', 'email'));

    //     return Redirect::back()->with('success', 'User updated.');
    // }

    // public function destroy(User $user)
    // {
    //     if ($user->isAdmin()) {
    //         return Redirect::back()->with('error', 'Deleting the Admin user is not allowed.');
    //     }
    //     $user->delete();

    //     return Redirect::back()->with('success', 'User deleted.');
    // }

    // public function restore(User $user)
    // {
    //     $user->restore();

    //     return Redirect::back()->with('success', 'User restored.');
    // }
}
