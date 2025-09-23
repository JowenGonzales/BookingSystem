@extends('users.users_layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card mb-4 shadow">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-calendar-plus me-1"></i>
                    Create New Booking
                </div>
                <div class="card-body">
                    <form action="{{route('user.mybooking.createbooking.store')}}" method="POST">
                        @csrf

                        {{-- Service Name --}}
                        <div class="mb-3">
                            <label for="service_name" class="form-label">Service Name</label>
                            <input type="text"
                                   name="service_name"
                                   id="service_name"
                                   value="{{ old('service_name') }}"
                                   class="form-control @error('service_name') is-invalid @enderror"
                                   placeholder="Enter service name">
                            @error('service_name')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Scheduled At --}}
                        <div class="mb-3">
                            <label for="scheduled_at" class="form-label">Schedule Date & Time</label>
                            <input type="datetime-local"
                                   name="scheduled_at"
                                   id="scheduled_at"
                                   value="{{ old('scheduled_at') }}"
                                   class="form-control @error('scheduled_at') is-invalid @enderror">
                            @error('scheduled_at')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Amount --}}
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number"
                                   name="amount"
                                   id="amount"
                                   step="0.01"
                                   value="{{ old('amount') }}"
                                   class="form-control @error('amount') is-invalid @enderror"
                                   placeholder="Enter amount">
                            @error('amount')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>




                        {{-- Notes --}}
                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes (optional)</label>
                            <textarea name="notes"
                                      id="notes"
                                      class="form-control @error('notes') is-invalid @enderror"
                                      rows="3"
                                      placeholder="Enter additional notes">{{ old('notes') }}</textarea>
                            @error('notes')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <div class="d-flex justify-content-end">
                            <a href="" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Save Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
