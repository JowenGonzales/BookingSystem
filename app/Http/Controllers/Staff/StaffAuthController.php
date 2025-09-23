<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StaffAuthController extends Controller
{
    public function getLogin()
    {
        return view('staff.auth.login' , [

        ]);
    }

    public function postLogin(Request $request)
    {

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $staff = Staff::where('email' , $request->input('email'))->first();

        if ($staff) {
            if(auth()->guard('staff')->attempt(['email' => $request->input('email'),  'password' => $request->input('password')])){
                $staff = auth()->guard('staff')->user();

                return redirect()->route('staff.home')->with('success','You are Logged in sucessfully.');

            } else {
                return back()->withErrors(['password' => 'Incorrect Password'])->withInput();
            }
        } else {
            return back()->withErrors(['username' => 'The provided username does not exist.'])->withInput();
        }

    }


    public function logout()
    {
        // Log out the staff
        auth()->guard('staff')->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        session()->flash('success', 'You are logged out successfully');

        // Redirect to the login page
        return redirect(route('staff.login'));
    }
}
