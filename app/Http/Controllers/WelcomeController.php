<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Inertia\Inertia;
use Inertia\Controller;
use App\Models\JotForms;
use App\Models\Settings;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $formType = "site";
        // $form = $formType == "site" ? Form::form() : JotForms::form();

        if ($formType == "site") {
            return Inertia::render('Guest/Welcome', [
                'form' => 1,
                'formType' => 1,
            ]);
        }

        return view('jot-form', ['src' => 'https://form.jotform.com/jsform/220395408855462']);
    }
}
