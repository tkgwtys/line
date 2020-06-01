@extends('layouts.admin')

@section('content')
    {{--    <div class="container">--}}
    <div class="col-12">
        <h1>トレーナ管理</h1>
        <h3>{{$player->sei}}{{$player->mei}}（{{$player->sei_hira}}{{$player->mei_hira}}）</h3>
        <p>{{$player->self_introduction}}</p>
        <img width="100" src="{{ asset('storage/images/players/'. $player->id .'/original.jpg')}}" width="300">
    </div>
    {{--    </div>--}}
    @include('common.reservation_table', ['time_array' => $time_array])
@endsection
