@if($booking->payments->count() > 0)
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-list me-1"></i> Payment History
            </div>
            <div>
                <strong>Booking Paid:</strong>
                @if($booking->is_paid)
                    <span class="badge bg-success">Yes</span>
                @else
                    <span class="badge bg-warning text-dark">No</span>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Notes</th>
                        <th>Submitted At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($booking->payments as $index => $payment)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>₱{{ number_format($payment->amount, 2) }}</td>
                            <td><x-status-badge :status="$payment->status" /></td>
                            <td>{{ $payment->notes ?? '-' }}</td>
                            <td>{{ $payment->created_at->format('M d, Y h:i A') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
