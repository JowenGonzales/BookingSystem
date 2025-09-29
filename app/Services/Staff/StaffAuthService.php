<?php

namespace App\Services\Staff;

use App\Models\Staff;
use App\Repositories\Staff\StaffAuthRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffAuthService
{

    protected $staffRepo;
    public function __construct(StaffAuthRepositoryInterface $staffRepo)
    {
        $this->staffRepo = $staffRepo;
    }

    public function login(array $credentials): bool
    {

        $staff = $this->staffRepo->findByEmail($credentials['email']);
        if (! $staff) {
            throw new \Exception('The provided Email does not exist!.');
        }

        if (!Auth::guard('staff')->attempt($credentials)) {
            throw new \Exception('Incorrect Password');
        }

        return true;

    }

    public function logout(): void
    {
        Auth::guard('staff')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }



}
