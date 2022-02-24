<?php

namespace App\Models;

use JotForm;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class JotForms extends Model
{
    use HasFactory;




    public static function forms()
    {
        $jotformAPI = new JotForm(env('JOTFORM_API_KEY'));
        return $jotformAPI->getForms();
    }

    public static function form($id)
    {
        $jotformAPI = new JotForm(env('JOTFORM_API_KEY'));
        return $jotformAPI->getForm($id);
    }

    public static function formSubmission($id)
    {
        $jotformAPI = new JotForm(env('JOTFORM_API_KEY'));
        return $jotformAPI->getFormSubmissions($id);
    }


    public static function submission($id)
    {
        $jotformAPI = new JotForm(env('JOTFORM_API_KEY'));
        return $jotformAPI->getSubmission($id);
    }
}
