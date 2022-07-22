<?php

namespace App\Models;

use JotForm;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class JotForms extends Model
{
    use HasFactory;

    protected static function jotFormAPI()
    {
        return new JotForm(env('JOTFORM_API_KEY'));
    }

    public static function forms()
    {
        return self::jotFormAPI()->getForms();
    }

    public static function form($id)
    {
        return self::jotFormAPI()->getForm($id);
    }

    public static function formSubmission($id)
    {
        return self::jotFormAPI()->getFormSubmissions($id);
    }


    public static function submission($id)
    {
        return self::jotFormAPI()->getSubmission($id);
    }
}
