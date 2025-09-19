@extends('staff.staff_layout')
@section('page-title' , "All Bookings")
@section('page-breadcrumb')
    <li class="breadcrumb-item active">Bookings</li>
    <li class="breadcrumb-item active">All Bookings</li>
@endsection
@section('content')

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-calendar-check me-1"></i>
                Manage Bookings
            </div>
            <a href="{{route('staff.mybooking.createbooking')}}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> New Booking
            </a>
        </div>



        <div class="card-body">
            {{-- Include Filter Form --}}
            @include('staff.bookings._filter_form')
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                <tr>
                    <th>User Name</th>
                    <th>Reference Code</th>
                    <th>Service</th>
                    <th>Schedule</th>
                    <th>Status</th>
                    <th>Payment Method</th>
                    <th>Amount</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->reference_code }}</td>
                        <td>{{ $booking->service_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y h:i A') }}</td>
                        <td>
                            <x-status-badge :status="$booking->status"/>
                        </td>
                        <td>{{ ucfirst($booking->payment_method) }}</td>
                        <td>₱{{ number_format($booking->amount, 2) }}</td>
                        <td>{{ $booking->notes ?? '-' }}</td>
                        <td>
                            <a href="{{route('staff.bookings.viewbooking', $booking->id)}}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
