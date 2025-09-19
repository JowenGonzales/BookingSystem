@extends('staff.staff_layout')

@section('page-title' , "View Booking")

@section('page-breadcrumb')
    <li class="breadcrumb-item"><a >Bookings</a></li>
    <li class="breadcrumb-item"><a href="{{ route('staff.bookings.allbookings') }}">All Bookings</a></li>
    <li class="breadcrumb-item active">View Booking</li>
    <li class="breadcrumb-item active">{{$booking->reference_code}}</li>
@endsection

@section('content')

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-eye me-1"></i>
                Booking Details
            </div>
            <a href="{{ route('staff.bookings.allbookings') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Back to All Bookings
            </a>
        </div>
        <div class="card-body">
            <dl class="row">

                <dt class="col-sm-3">Customer</dt>
                <dd class="col-sm-9">
                    {{ $booking->user->name ?? 'N/A' }}
                    <br>
                    <small class="text-muted">{{ $booking->user->email ?? '' }}</small>
                </dd>



                <dt class="col-sm-3">Reference Code</dt>
                <dd class="col-sm-9">{{ $booking->reference_code }}</dd>

                <dt class="col-sm-3">Service</dt>
                <dd class="col-sm-9">{{ $booking->service_name }}</dd>

                <dt class="col-sm-3">Schedule</dt>
                <dd class="col-sm-9">{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y h:i A') }}</dd>
                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">
                    <x-status-badge :status="$booking->status" />
                    <x-booking.status-control :booking="$booking" />
                </dd>


                <dt class="col-sm-3">Payment Method</dt>
                <dd class="col-sm-9">{{ ucfirst($booking->payment_method) }}</dd>


                <dt class="col-sm-3">Notes</dt>
                <dd class="col-sm-9">{{ $booking->notes ?? '-' }}</dd>

                <dt class="col-sm-3">Created At</dt>
                <dd class="col-sm-9">{{ $booking->created_at->format('M d, Y h:i A') }}</dd>

                <dt class="col-sm-3">Last Updated</dt>
                <dd class="col-sm-9">{{ $booking->updated_at->format('M d, Y h:i A') }}</dd>
            </dl>

            {{-- Show Pay Now button if pending --}}
            @if(!$booking->is_paid)
                <button id="showPaymentForm" class="btn btn-primary">
                    <i class="fas fa-credit-card me-1"></i> Mark as Paid
                </button>
            @endif
        </div>
    </div>
    {{-- Hidden Payment Form --}}
    {{-- Hidden Mark as Paid Form --}}
    <div id="paymentForm" class="card d-none mt-3">
        <div class="card-header">
            <i class="fas fa-cash-register me-1"></i> Record Cash Payment
        </div>
        <div class="card-body">
            <form action="{{ route('payments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" step="0.01" name="amount" class="form-control" value="{{ $booking->amount }}" required>
                </div>

                <div class="mb-3">
                    <label for="receipt_number" class="form-label">Receipt Number (optional)</label>
                    <input type="text" name="receipt_number" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="paid_at" class="form-label">Paid At</label>
                    <input type="datetime-local" name="paid_at" class="form-control" value="{{ now()->format('Y-m-d\TH:i') }}">
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label">Notes (optional)</label>
                    <textarea name="notes" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check me-1"></i> Confirm Payment
                </button>
            </form>
        </div>
    </div>

    <x-booking.payment-history :booking="$booking" />



@endsection

@section('scripts')
    <script>
        document.getElementById('showPaymentForm')?.addEventListener('click', function () {
            document.getElementById('paymentForm').classList.remove('d-none');
            this.classList.add('d-none'); // hide button after click
        });
    </script>
@endsection
