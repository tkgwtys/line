@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>トレーナ管理</h1>
        {{$player_image->player_id}}
        <h3>{{$player->sei}}{{$player->mei}}（{{$player->sei_hira}}{{$player->mei_hira}}）</h3>
        <p>{{$player->self_introduction}}</p>
        <img src="{{ asset('storage/images/players/'. $player_id .'/'.$player_image->file_name)}}" width="300">
    </div>
@endsection
