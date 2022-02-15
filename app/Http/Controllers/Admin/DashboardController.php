<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\JotForm;
use App\Http\Controllers\Admin\AdminBaseController;

class DashboardController extends AdminBaseController
{
    public function index()
    {
        return Inertia::render('Dashboard/Index', [
            'forms' => JotForm::Forms()  ,
        ]);
    }
}
