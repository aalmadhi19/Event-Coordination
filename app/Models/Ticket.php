<?php

namespace App\Models;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'qr_path',
        'form_id',
        'submission_id',
        'status',
        'expiration'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->with('user', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        })->when($filters['status'] ?? null, function ($query, $status) {
            $query->where('status', 'like', '%' . $status . '%');
        });
    }

    public function scopeAuth($query)
    {
        $query->where('user_id', auth()->user()->id);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function form()
    {
        return $this->hasMany(JotForm::class);
    }


    public static function qrCode($code)
    {
        try {
            $decrypted = json_decode(Crypt::decryptString($code), true);
        } catch (DecryptException $e) {
            return false;
        }
        return self::find($decrypted['ticket_id']);
    }

    public static function login(self $ticket)
    {
        if ($ticket->status == "in" || $ticket->status == "out") {
            return [
                'type' => "error",
                'message' => "Sorry, the ticket is already used!"
            ];
        }

        if ($ticket->expiration < now()) {
            return [
                'type' => "error",
                'message' => "Sorry, ticket expired!"
            ];
        }

        $ticket->status = 'in';
        $ticket->update();
        return [
            'type' => "success",
            'message' => "Enjoy!"
        ];
    }

    public static function logout(self $ticket)
    {
        $ticket->status = 'out';
        $ticket->update();
    }
}
