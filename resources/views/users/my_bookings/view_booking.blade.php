@extends('users.users_layout')

@section('page-title' , "View Booking")

@section('page-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('mybooking.managebookings') }}">My Bookings</a></li>
    <li class="breadcrumb-item active">View Booking</li>
@endsection

@section('content')

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-eye me-1"></i>
                Booking Details
            </div>
            <div>

                <a href="{{ route('mybooking.managebookings') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back to Bookings
                </a>

                <a href="{{ route('user.mybooking.managebookings.editbooking', $booking->id) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit me-1"></i> Edit Booking
                </a>
            </div>

        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Reference Code</dt>
                <dd class="col-sm-9">{{ $booking->reference_code }}</dd>

                <dt class="col-sm-3">Service</dt>
                <dd class="col-sm-9">{{ $booking->service_name }}</dd>

                <dt class="col-sm-3">Schedule</dt>
                <dd class="col-sm-9">{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y h:i A') }}</dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">
                    <x-status-badge :status="$booking->status" />
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


        </div>
    </div>




    <x-booking.payment-history :booking="$booking" />


@endsection

@section('scripts')
    <script>
        document.getElementById('showPaymentForm')?.addEventListener('click', function () {
            document.getElementById('paymentForm').classList.remove('d-none');
            this.classList.add('d-none'); // hide Pay Now button after click
        });
    </script>
@endsection
