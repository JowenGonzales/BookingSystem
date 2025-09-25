@extends('staff.staff_layout')
@section('page-title' , "Dashboard")
@section('head')
    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.css' rel='stylesheet' />

@endsection

@section('page-breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('content')


    <div class="row mb-4">

        {{-- Total Bookings --}}
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body bg-primary text-white rounded-top">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-2">Total Bookings</h5>
                            <h2 class="mb-1">{{ $totalBookings }}</h2>
                        </div>
                        <div>
                            <i class="fas fa-calendar-check fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-warning text-dark">Pending: {{ $bookingsByStatus['pending'] ?? 0 }}</span>
                        <span class="badge bg-info text-dark">Confirmed: {{ $bookingsByStatus['confirmed'] ?? 0 }}</span>
                        <span class="badge bg-success">Completed: {{ $bookingsByStatus['completed'] ?? 0 }}</span>
                        <span class="badge bg-danger">Cancelled: {{ $bookingsByStatus['cancelled'] ?? 0 }}</span>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                    <a class="small text-primary stretched-link" href="{{route('staff.bookings.allbookings')}}">View Details</a>
                    <div class="small text-muted"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        {{-- Total Revenue --}}
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body bg-success text-white rounded-top d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-2">Total Revenue</h5>
                        <h2 class="mb-1">₱{{ number_format($totalRevenue, 2) }}</h2>
                    </div>
                    <div>
                        <i class="fas fa-money-bill-wave fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                    <a class="small text-success stretched-link" href="">View Payments</a>
                    <div class="small text-muted"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        {{-- Today's Bookings --}}
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body bg-warning text-dark rounded-top d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-2">Today's Bookings</h5>
                        <h2 class="mb-1">{{ $todayBookings }}</h2>
                    </div>
                    <div>
                        <i class="fas fa-calendar-day fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                    <a class="small text-dark stretched-link" href="">View Bookings</a>
                    <div class="small text-muted"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        {{-- Unpaid Bookings --}}
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body bg-danger text-white rounded-top d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-2">Unpaid Bookings</h5>
                        <h2 class="mb-1">{{ $unpaidBookings }}</h2>
                    </div>
                    <div>
                        <i class="fas fa-exclamation-circle fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                    <a class="small text-danger stretched-link" href="">View Unpaid</a>
                    <div class="small text-muted"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Booking Calendar</h5>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>




@endsection

@section('scripts')

    <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 600,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: @json($events)
            });

            calendar.render();
        });
    </script>

@endsection
