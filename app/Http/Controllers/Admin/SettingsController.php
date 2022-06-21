<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Settings;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;

class SettingsController extends AdminBaseController
{
    public function index()
    {
        return Inertia::render('Settings/Index', [
            'settings' => Settings::all(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Settings/Create', [
            'types' => Settings::types(),
            'fonts' => Settings::fonts(),
        ]);
    }

    public function store()
    {
        Request::validate([
            'name' => ['required'],
            'type' => ['required'],
            'selector' => ['nullable'],
            'property' => ['nullable'],
            'value' => ['required'],
        ]);

        $settings = Settings::create([
            'name' => Request::get('name'),
            'type' => Request::get('type'),
            'selector' => Request::get('selector'),
            'property' => Request::get('property'),
            'value' => Request::file('value') ? Request::file('value')->store('public/logo') : Request::get('value'),
        ]);
        $settings->setCss();

        return Redirect::back()->with('success', 'Settings created.');
    }


    public function update(Settings $setting)
    {
        $setting->update(Request::all());
        $setting->setCss();

        return Redirect::back()->with('success', 'Settings updated.');
    }

    public function destroy(Settings $setting)
    {
        $setting->delete();
        return Redirect::back()->with('success', 'Settings deleted.');
    }
}
