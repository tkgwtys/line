@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>トレーナ管理</h1>
        <input value="" class="selector" type="text"/>
        <h3>{{$player->sei}}{{$player->mei}}（{{$player->sei_hira}}{{$player->mei_hira}}）</h3>
        <p>{{$player->self_introduction}}</p>
        <img src="{{ asset('storage/images/players/'. $player->id .'/original.jpg')}}" width="300">
    </div>
    @include('common.reservation_table', ['time_array' => $time_array])
@endsection
