<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'qr_path',
        'form_id',
        'submission_id'
    ];

    // protected $appends = ['download'];


    // public function getDownloadAttribute()
    // {
    //  return '<a href="/download/' . $this->qr_path . '" target="_blank" class="btn btn-primary"><i class="fa fa-download"></i> تحميل</a>';

    // }
}
