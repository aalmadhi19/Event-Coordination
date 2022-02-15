<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class JotForm extends Model
{
    use HasFactory;

    public static function Forms()
    {
        $forms = Http::withHeaders([
            'APIKEY' => env('JOTFORM_API_KEY'),
        ])->get('https://api.jotform.com/user/forms');
        return $forms->json();
    }

    public static function form()
    {
         $form = Http::withHeaders([
             'APIKEY' => env('JOTFORM_API_KEY'),
         ])->post('https://api.jotform.com/form/220395408855462/clone?');

        return $form->json();
    }
}
