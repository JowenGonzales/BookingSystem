@if(auth()->guard('staff')->check() || auth()->user()?->isAdmin())
    <form action="{{ route('staff.bookings.updatestatus', $booking) }}" method="POST" class="d-inline ms-3">
        @csrf
        @method('PATCH')
        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
        <select name="status" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
    </form>
@endif
