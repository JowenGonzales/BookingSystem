<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //

    public function customers()
    {
        $users = User::all();
        return view('staff.users.customers' , [
            'users' => $users,
        ]);
    }


}
