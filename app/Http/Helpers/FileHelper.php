<?php

namespace App\Http\Helpers;


use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class FileHelper
{


    public static function storageUrl(?string $path): string
    {
        if (!$path) {
            return asset('images/no-image.png'); // fallback image
        }

        return asset('storage/' . $path);
    }


}
