<?php

namespace App\Repositories\Staff;

use App\Models\Staff;

class StaffAuthRepository implements StaffAuthRepositoryInterface
{


    public function findByEmail(string $email): ?Staff
    {
        // TODO: Implement findByEmail() method.
        return Staff::where('email' , $email)->first();

    }
}
