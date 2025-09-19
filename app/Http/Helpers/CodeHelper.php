<?php

namespace App\Http\Helpers;


use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CodeHelper
{


    public static function generateBookingCode() : string
    {
        return strtoupper(Str::random(10));
    }


}
