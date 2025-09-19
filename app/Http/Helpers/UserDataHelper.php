<?php

namespace App\Http\Helpers;


use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UserDataHelper
{


    public static function getUser() : User
    {
        $user = User::find(Auth::id());
        return $user;
    }
}
