@extends('users.users_layout')

@section('page-title', "My Payments")

@section('page-breadcrumb')
    <li class="breadcrumb-item active">My Payments</li>
@endsection

@section('content')



    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-wallet me-1"></i>
            Payment History
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                <tr>
                    <th>Reference Code</th>
                    <th>Service</th>
                    <th>Payment Date</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr>

                        <td>{{ $payment->booking->reference_code }}</td>
                        <td>{{ $payment->booking->service_name }}</td>
                        <td>{{ $payment->created_at->format('M d, Y h:i A') }}</td>
                        <td>₱{{ number_format($payment->amount, 2) }}</td>
                        <td>{{ ucfirst($payment->payment_method) }}</td>
                        <td>
                            <x-status-badge :status="$payment->status" />
                        </td>
                        <td>

                            <a href="{{ route('user.mybooking.managebookings.viewbooking', $payment->booking_id) }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-calendar-check"></i> Booking
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
