@extends('layouts.dashboard')

@section('title', 'My Calender Detail')

@section('content')

<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Calender</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Calender</li>
                </ul>
            </div>
        </div>
        <!-- [ page-header ] end -->

        <!-- [ Main Content ] start -->
        <div class="main-content">
            <!-- Calendar Header -->
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Attendance Calendar - {{ \Carbon\Carbon::createFromDate($currentYear, $currentMonth, 1)->format('F Y') }}</h5>
                    <div class="d-flex">
                        <a href="{{ route('mycalender', [$currentMonth == 1 ? 12 : $currentMonth - 1, $currentMonth == 1 ? $currentYear - 1 : $currentYear]) }}" class="btn btn-sm btn-outline-secondary me-2">Prev</a>
                        <a href="{{ route('mycalender', [$currentMonth == 12 ? 1 : $currentMonth + 1, $currentMonth == 12 ? $currentYear + 1 : $currentYear]) }}" class="btn btn-sm btn-outline-secondary">Next</a>
                    </div>
                </div>

                <!-- Day Labels -->
                <div class="card-body">
                    <div class="day-labels">
                        @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                            <div>{{ $day }}</div>
                        @endforeach
                    </div>

                    <!-- Calendar Grid -->
                    <div class="calendar-grid">
                        @php
                            use Carbon\Carbon;

                            $startOfMonth = Carbon::createFromDate($currentYear, $currentMonth, 1);
                            $daysInMonth = $startOfMonth->daysInMonth;
                            $startDay = $startOfMonth->dayOfWeek;

                            $attendanceMap = $attendances->keyBy(fn($a) => Carbon::parse($a->date)->format('Y-m-d'));
                            $holidayMap = $holidays->keyBy(fn($h) => Carbon::parse($h->date)->format('Y-m-d'));
                        @endphp

                        {{-- Blank Days Before Start --}}
                        @for ($i = 0; $i < $startDay; $i++)
                            <div class="calendar-day empty"></div>
                        @endfor

                        {{-- Calendar Days --}}
                        @for ($day = 1; $day <= $daysInMonth; $day++)
                            @php
                                $date = Carbon::createFromDate($currentYear, $currentMonth, $day);
                                $dateStr = $date->format('Y-m-d');
                                $classes = 'calendar-day';
                                $label = '';

                                if (isset($holidayMap[$dateStr])) {
                                    $classes .= ' holiday';
                                    $label = $holidayMap[$dateStr]->name;
                                } elseif (isset($attendanceMap[$dateStr])) {
                                    if ($attendanceMap[$dateStr]->status == 'Present') {
                                        $classes .= ' present';
                                        $label = 'Present';
                                    } elseif ($attendanceMap[$dateStr]->status == 'Absent') {
                                        $classes .= ' absent';
                                        $label = 'Absent';
                                    }
                                }
                            @endphp

                            <div class="{{ $classes }}">
                                <div class="date-number">{{ $day }}</div>
                                @if($label)
                                    <small>{{ $label }}</small>
                                @endif
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

        </div>
        <!-- [ Main Content ] end -->

    </div>
</main>
<style>
    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 10px;
    }

    .calendar-day {
        border-radius: 12px;
        padding: 12px;
        background-color: #f8f9fa;
        min-height: 100px;
        position: relative;
        transition: all 0.2s ease-in-out;
    }

    .calendar-day:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .calendar-day.empty {
        background: transparent;
        box-shadow: none;
    }

    .calendar-day .date-number {
        font-weight: 600;
    }

    .calendar-day small {
        display: block;
        font-size: 12px;
        margin-top: 6px;
        word-wrap: break-word;
    }

    .calendar-day.present {
        background-color: #e8f5e9;
        border-left: 4px solid #28a745;
    }

    .calendar-day.absent {
        background-color: #fcebea;
        border-left: 4px solid #dc3545;
    }

    .calendar-day.holiday {
        background-color: #fff8e1;
        border-left: 4px solid #ffc107;
    }

    .day-labels {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        margin-bottom: 10px;
        font-weight: 600;
        color: #495057;
        text-align: center;
    }
</style>

@endsection
