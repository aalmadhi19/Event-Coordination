<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Ticket;

class CoordinateController extends AdminBaseController
{
    public function index()
    {
        return Inertia::render('Coordination/Index');
    }

    public function login()
    {
        return Inertia::render('Coordination/Login/Index', [
            'current_attendees' => Ticket::all()  ,
        ]);
    }


    public function logout()
    {
        return Inertia::render('Coordination/Index');
    }


}
