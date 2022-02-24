<?php

namespace App\Http\Controllers\Admin;

use App\Models\Form;
use Inertia\Inertia;
use App\Models\JotForms;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminBaseController;

class FormController extends AdminBaseController
{
    public function index()
    {
        return Inertia::render('Forms/Index', [
            'forms' => JotForms::forms(),
        ]);
    }


    public function show($id)
    {
        return Inertia::render('Forms/Show', [
            'form' => JotForms::form($id),
            'submissions' => JotForms::formSubmission($id),
        ]);
    }


    public function submission($id)
    {
        return Inertia::render('Forms/Submission', [
            'submission' => JotForms::submission($id),
        ]);
    }
}
