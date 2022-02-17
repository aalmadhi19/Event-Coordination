<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class ManagementController extends Controller
{
    public function index()
    {

    //    $config =  Config::all();
    //     dd($config );
        return Inertia::render('Management/Index', [
            'settings' => Settings::all(),
        ]);
    }
}
