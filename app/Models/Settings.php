<?php

namespace App\Models;

use App\Jobs\CompileAssets;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Http;

class Settings extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'name',
        'type',
        'selector',
        'property',
        'value',
    ];

    public function scopeCss($query)
    {
        $query->where('type', 'css');
    }

    public function scopeForm($query)
    {
        $query->where('type', 'forms');
    }

    public function setCss()
    {
        if ($this->type == "css") {

            $currentCss = self::css()->get();

            $cssSyntax = [];

            foreach ($currentCss  as $css) {
                $cssSyntax[] = self::cssSyntax($css);
            }
            File::replace(public_path('css/DB.css'), implode(PHP_EOL, $cssSyntax));
            // $job = new CompileAssets();
            // $job->dispatch();
        }
    }

    public static function cssSyntax($css)
    {
        return
            $css->selector . '{' .
            $css->property . ':' . $css->value . ';'
            . '}';
    }


    public static function logo()
    {
        $logo = self::where('type', 'logo')->latest()->first();
        if ($logo) {
            return '/logo/' . explode('/', $logo->value)[2];
        }
        return '/assets/The-Nizer1.png';
    }

    public static function types()
    {
        return [
            'forms',
            'logo',
            'css',
            'font',
        ];
    }

    public static function fonts()
    {
        $fonts = Http::get('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyCBpGhzEHM4mMMR-CsgDsw-oGsppkLebo4');
        return $fonts['items'];
    }


    public static function formType()
    {
        return self::form()->first()->value;
    }

}
