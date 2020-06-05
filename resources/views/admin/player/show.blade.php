@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        {{ Breadcrumbs::render('showUser', $player) }}
    </div>
    @include('common.reservation_table', ['time_array' => $time_array])
@endsection
