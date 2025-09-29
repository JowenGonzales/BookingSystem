<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Models\Booking;
use App\Models\Payment;
use App\Services\Staff\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    protected $payments;
    public function __construct(PaymentService $payments)
    {
        $this->payments = $payments;
    }

    public function store(StorePaymentRequest $request)
    {
        $this->payments->storePayment($request->validated());
        return redirect()
            ->back()
            ->with('success', 'Payment submitted successfully! Please wait for confirmation.');
    }
}
