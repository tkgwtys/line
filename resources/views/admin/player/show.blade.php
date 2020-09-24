@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        {{ Breadcrumbs::render('adminPlayerSchedule', $player) }}
        @include('common.reservation_table', [
    'time_array' => $time_array,
    'users' => $users,
    'days_array' =>$days_array,
    'reservations' => $reservations,
    'courses' => $courses,
    'start_month' => $start_month,
    ])
    </div>
@endsection
