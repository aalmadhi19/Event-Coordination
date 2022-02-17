<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Admin\AdminBaseController;

class CoordinateController extends AdminBaseController
{
    public function index()
    {
        return Inertia::render('Coordination/Index');
    }

    public function login()
    {
        return Inertia::render('Coordination/Login/Index', [
            'filters' => Requests::all('search', 'status'),
            'current_attendees' => Ticket::filter(Requests::only('search', 'status'))
            ->with('user')->paginate(20),
        ]);
    }

    public function logout()
    {        
        return Inertia::render('Coordination/Logout/Index', [
            'current_attendees' => Ticket::with('user')->paginate(20),
        ]);
    }

    public function loginRead(Request $request)
    {
        $ticket = Ticket::qrCode($request->code);

        if ($ticket == false) {
            return Redirect::back()->with('error', 'The ticket is invalid try again.');
        }

        $loginAttempt = Ticket::login($ticket);

        return Redirect::back()->with($loginAttempt['type'],$loginAttempt['message']);
    }

    public function logoutRead(Request $request)
    {
        $ticket = Ticket::qrCode($request->code);

        if ($ticket == false) {
            return Redirect::back()->with('error', 'The ticket is invalid try again.');
        }

        Ticket::logout($ticket);

        return Redirect::back()->with('success', 'Ticket logged out successfully. come again!');
    }
}
