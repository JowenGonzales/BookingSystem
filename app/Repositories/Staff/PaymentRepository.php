<?php

namespace App\Repositories\Staff;

use App\Models\Payment;

class PaymentRepository implements PaymentRepositoryInterface
{

    public function create(array $data)
    {
        // TODO: Implement create() method.
        return Payment::create($data);
    }
}
