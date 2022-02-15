<?php

namespace App\Http\Controllers\Auth;

use App\Classes\Utils;
use App\Models\Ticket;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RegistrationController extends Controller
{

    /**
     * Handle an incoming authentication request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|regex:/^(05)([0-9]{8})$/|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        DB::transaction(function () use ($request) {

            // Create User
            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole('User');

            // Create Ticket
            $ticket = Ticket::create([
                'user_id' => $user->id,
            ]);

            $qrCodePath = Utils::qrCode($user);

            $ticket->update([
                'qr_path' => $qrCodePath
            ]);

            event(new Registered($user));
            Auth::login($user);
        });



        return redirect(RouteServiceProvider::HOME);
    }
}
