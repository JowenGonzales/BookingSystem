<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffAuthLoginRequest;
use App\Models\Admin;
use App\Models\Staff;
use App\Models\User;
use App\Services\Staff\StaffAuthService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StaffAuthController extends Controller
{

    protected $authService;
    public function __construct(StaffAuthService $authService)
    {
        $this->authService = $authService;
    }


    public function getLogin()
    {
        return view('staff.auth.login' , [

        ]);
    }

    public function postLogin(StaffAuthLoginRequest $request)
    {

        try {
            $this->authService->login($request->only('email' , 'password'));
            return redirect()->route('staff.home');

        } catch (\Exception $e) {
            return back()->withErrors(['auth' => $e->getMessage()])->withInput();
        }

    }


    public function logout()
    {
        $this->authService->logout();
        session()->flash('success', 'You are logged out successfully');

        return redirect()->route('staff.login');
    }
}
