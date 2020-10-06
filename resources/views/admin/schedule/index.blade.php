@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        {{ Breadcrumbs::render('adminSchedule') }}
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
    'unsettled' => $unsettled,
    'reservation_memos' => $reservation_memos,
    ])
    </div>
@endsection
