@extends('layouts.admin')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('admin.player') }}
        <h1>トレーナ管理</h1>
        <p>
            <a href="{{url('/admin/player/create')}}" class="btn btn-primary">トレーナ登録</a>
        </p>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">名前</th>
                <th scope="col">写真</th>
                <th scope="col">登録日</th>
            </tr>
            </thead>
            <tbody>
            @foreach($players as $player)
                <tr>
                    <td>
                        <a href="{{url('/admin/player/'. $player->id)}}">
                            {{$player->sei}}{{$player->mei}}（{{$player->sei_hira}}{{$player->mei_hira}}）
                        </a>
                    </td>
                    <td>
                        <img src="{{ asset('storage/images/players/'. $player->id .'/'. $player->images->file_name)}}"
                             width="50"></td>
                    <td>{{$player->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
