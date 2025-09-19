@props(['status'])

@switch($status)
    @case('pending')
        <span class="badge bg-warning text-dark">Pending</span>
        @break

    @case('confirmed')
        <span class="badge bg-success">Confirmed</span>
        @break

    @case('completed')
        <span class="badge bg-primary">Completed</span>
        @break

    @case('cancelled')
        <span class="badge bg-danger">Cancelled</span>
        @break

    @case('approved')
        <span class="badge bg-success">Approved</span>
        @break

    @case('rejected')
        <span class="badge bg-danger">Rejected</span>
        @break

    @default
        <span class="badge bg-secondary">{{ ucfirst($status) }}</span>
@endswitch
