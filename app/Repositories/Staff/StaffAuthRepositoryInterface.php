<?php

namespace App\Repositories\Staff;

use App\Models\Staff;

interface StaffAuthRepositoryInterface
{
    public function findByEmail(string $email) : ?Staff ;
}
