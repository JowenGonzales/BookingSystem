{{-- resources/views/staff/bookings/_filter_form.blade.php --}}
<form action="{{ route('staff.bookings.allbookings') }}" method="GET" class="row g-3 mb-4">
    <div class="col-md-3">
        <label for="date_from" class="form-label">From Date</label>
        <input type="date" name="date_from" id="date_from" class="form-control"
               value="{{ request('date_from') }}">
    </div>
    <div class="col-md-3">
        <label for="date_to" class="form-label">To Date</label>
        <input type="date" name="date_to" id="date_to" class="form-control"
               value="{{ request('date_to') }}">
    </div>
    <div class="col-md-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select">
            <option value="">All</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
    </div>
    <div class="col-md-3">
        <label for="payment_state" class="form-label">Payment State</label>
        <select name="payment_state" id="payment_state" class="form-select">
            <option value="">All</option>
            <option value="paid" {{ request('payment_state') == 'paid' ? 'selected' : '' }}>Paid</option>
            <option value="unpaid" {{ request('payment_state') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
        </select>
    </div>
    <div class="col-md-12 text-end">
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('staff.bookings.allbookings') }}" class="btn btn-secondary">Reset</a>
    </div>
</form>
