@extends('staff.staff_layout')
@section('page-title', "Analytics")

@section('page-breadcrumb')
    <li class="breadcrumb-item active">Reports</li>
    <li class="breadcrumb-item active">Analytics</li>
@endsection

@section('content')

    {{-- Date Range Filter --}}
    <form action="{{ route('staff.analytics') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <label for="date_from" class="form-label">From</label>
            <input type="date" name="date_from" id="date_from" class="form-control"
                   value="{{ request('date_from', \Carbon\Carbon::today()->format('Y-m-d')) }}">
        </div>
        <div class="col-md-3">
            <label for="date_to" class="form-label">To</label>
            <input type="date" name="date_to" id="date_to" class="form-control"
                   value="{{ request('date_to', \Carbon\Carbon::today()->format('Y-m-d')) }}">
        </div>
        <div class="col-md-6 text-end align-self-end">
            <button type="submit" class="btn btn-primary">Apply</button>
            <a href="{{ route('staff.analytics') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    {{-- KPI Cards --}}
    <div class="row">
        {{-- Total Bookings --}}
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    Total Bookings: {{ $totalBookings }}
                    <br>
                    <small>
                        Confirmed: {{ $bookingsByStatus['confirmed'] ?? 0 }},
                        Completed: {{ $bookingsByStatus['completed'] ?? 0 }},
                        Cancelled: {{ $bookingsByStatus['cancelled'] ?? 0 }}
                    </small>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <span class="small text-white">Details</span>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>

        {{-- Cash Revenue --}}
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    Cash Revenue: ₱{{ number_format($cashRevenue, 2) }}
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <span class="small text-white">Payments</span>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>

        {{-- Unpaid Bookings --}}
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    Unpaid Bookings: {{ $unpaidBookings }}
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <span class="small text-white">Details</span>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>

        {{-- Payment Conversion --}}
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-dark mb-4">
                <div class="card-body">
                    Payment Conversion: {{ $paymentConversion }}%
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <span class="small text-dark">Stats</span>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts --}}
    <div class="row">
        {{-- Bookings Over Time --}}
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-line me-1"></i> Bookings Over Time
                </div>
                <div class="card-body">
                    <canvas id="bookingsChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>

        {{-- Revenue Over Time --}}
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i> Revenue Over Time
                </div>
                <div class="card-body">
                    <canvas id="revenueChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Top Services --}}
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i> Top Services by Bookings
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Service</th>
                    <th>Bookings</th>
                </tr>
                </thead>
                <tbody>
                @foreach($topServices as $service => $count)
                    <tr>
                        <td>{{ $service }}</td>
                        <td>{{ $count }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // Example Chart.js charts
        const bookingsChart = new Chart(document.getElementById('bookingsChart'), {
            type: 'line',
            data: {
                labels: @json($chartDates),
                datasets: [{
                    label: 'Bookings',
                    data: @json($bookingsPerDay),
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true,
                    tension: 0.3
                }]
            }
        });

        const revenueChart = new Chart(document.getElementById('revenueChart'), {
            type: 'line',
            data: {
                labels: @json($chartDates),
                datasets: [{
                    label: 'Revenue',
                    data: @json($revenuePerDay),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                    tension: 0.3
                }]
            }
        });
    </script>
@endsection
