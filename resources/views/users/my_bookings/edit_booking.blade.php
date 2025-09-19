@extends('users.users_layout')

@section('page-title' , "Edit Booking")

@section('page-breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('mybooking.managebookings') }}">My Bookings</a></li>
    <li class="breadcrumb-item">Edit Booking</li>
    <li class="breadcrumb-item"><a >View Booking {{$booking->reference_code}}</a></li>
@endsection

@section('content')

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-edit me-1"></i>
                Edit Booking
            </div>
            <a href="{{ route('user.mybooking.managebookings.viewbooking', $booking->id) }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Back to Booking
            </a>
        </div>
        <div class="card-body">
            <form id="updateBookingForm" action="{{route('user.mybooking.managebookings.updatebooking', $booking->id)}}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="service_name" class="form-label">Service</label>
                    <input type="text" name="service_name" id="service_name" class="form-control"
                           value="{{ old('service_name', $booking->service_name) }}" required>
                    @error('service_name')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="booking_date" class="form-label">Schedule</label>
                    <input type="datetime-local" name="booking_date" id="booking_date" class="form-control"
                           value="{{ old('booking_date', \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d\TH:i')) }}" required>
                    @error('booking_date')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea name="notes" id="notes" class="form-control">{{ old('notes', $booking->notes) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancel</option>
                    </select>
                </div>

                <!-- Trigger Modal -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmUpdateModal">
                    <i class="fas fa-save me-1"></i> Update Booking
                </button>
            </form>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmUpdateModal" tabindex="-1" aria-labelledby="confirmUpdateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmUpdateModalLabel">Confirm Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to update this booking?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Cancel</button>
                    <button type="button" class="btn btn-success" onclick="document.getElementById('updateBookingForm').submit();">
                        Yes, Update
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
