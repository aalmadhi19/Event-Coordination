<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Ticket;
use App\Http\Controllers\Admin\AdminBaseController;

class DashboardController extends AdminBaseController
{
    public function index()
    {
        return Inertia::render('Dashboard/Index', [
            'tickets' => Ticket::all(),
            'ticketsIn' => Ticket::whereStatus('In')->count(),
            'ticketsOut' => Ticket::whereStatus('Out')->count(),
        ]);
    }
}
