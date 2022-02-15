<?php


namespace App\Classes;


use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Utils
{

    public static function uploadFile($request, $name, $target)
    {
        if ($request->hasFile($name)) {
            $file = $request->file($name);
            $ext = $file->getClientOriginalExtension();
            $filename = Time() . '.' . $ext;
            $file->move($target, $filename);
            return $target . $filename;
        }
    }

    public static function filePath()
    {
        $fileName = 'qrcodes/' . uniqid() . time() . '.svg';

        if (!Storage::exists('public/qrcodes')) {

            Storage::makeDirectory('public/qrcodes', 0775, true);
        }

        return $fileName;
    }

    public static function qrCode($user)
    {
        $data = [
            'id' => $user->id,
            'name' => $user->name,
            'ticket_id' => $user->ticket->id,
        ];

        $QrCode = Crypt::encryptString(json_encode($data));

        $filePath = self::filePath();

        QrCode::generate($QrCode, $filePath);

        return $filePath;
    }
}
