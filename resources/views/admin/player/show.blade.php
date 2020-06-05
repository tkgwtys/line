@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        {{ Breadcrumbs::render('adminPlayer', $player) }}
        @include('common.reservation_table', ['time_array' => $time_array])
    </div>
@endsection
