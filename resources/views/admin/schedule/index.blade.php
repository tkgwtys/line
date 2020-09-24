@extends('layouts.admin')

@section('content')
    {{ Breadcrumbs::render('adminSchedule') }}
    <div class="container-fluid">
        @include('common.reservation_table', [
    'time_array' => $time_array,
    'users' => $users,
    'days_array' =>$days_array,
    'reservations' => $reservations,
    'courses' => $courses,
    'start_month' => $start_month,
    'back_link' => $back_link,
    'next_link' => $next_link,
    'today_link' => $today_link,
    ])
    </div>
@endsection
