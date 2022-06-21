<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use App\Models\Ticket;
use App\Models\JotForm;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class TicketsController extends Controller
{
    public function index()
    {
        return Inertia::render('Tickets/Index', [
            'tickets' => Ticket::auth()
                ->get()
                ->transform(fn($ticket) => [
                    'id' => $ticket->id,
                    'path' => $ticket->qr_path,
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
            'ticket' => Ticket::with('user')->auth()->findOrFail($id)
        ]);
    }

    public function download($id)
    {
        $qrCode = Ticket::auth()->findOrFail($id)->qr_path;
        return Response::download($qrCode);

    }
}
