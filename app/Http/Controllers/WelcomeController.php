<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Controller;

class WelcomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Guest/Welcome', [
            'form' => 1,
            'formType' => 1,
        ]);
    }
}
