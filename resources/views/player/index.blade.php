@extends('layouts.app')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('userPlayer') }}
        <div class="row">
            <div class="col-md-12">
                <div id="alert_message"></div>
                @foreach($players as $player)
                    <div style="text-align: center; ">
                        <img
                            style="border-radius: 50%;width: 180px;height: 180px;"
                            src="{{ asset('storage/images/users/'. $player->id .'/original.jpg?'. time())}}"
                            width="200">
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{$player->sei}}{{$player->mei}}（{{$player->sei_hira}}{{$player->mei_hira}}）
                            </h5>
                            <p class="card-text">{{$player->self_introduction}}</p>
                        </div>
                    </div>
                    <br>
                    <a href="/reservation/{{$player->id}}"
                       type="button"
                       class="btn btn-primary btn-lg btn-block">予約申請する
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
{{--@extends('layouts.admin')--}}

{{--@section('content')--}}
{{--    <div class="container">--}}
{{--        {{ Breadcrumbs::render('admin.player') }}--}}
{{--        <h1>トレーナ管理</h1>--}}
{{--        <p>--}}
{{--            <a href="{{url('/admin/player/create')}}" class="btn btn-primary">トレーナ登録</a>--}}
{{--        </p>--}}
{{--        <table class="table table-striped">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th scope="col">名前</th>--}}
{{--                <th scope="col">写真</th>--}}
{{--                <th scope="col">登録日</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach($players as $player)--}}
{{--                <tr>--}}
{{--                    <td>--}}
{{--                        <a href="{{url('/admin/player/'. $player->id)}}">--}}
{{--                            {{$player->sei}}{{$player->mei}}（{{$player->sei_hira}}{{$player->mei_hira}}）--}}
{{--                        </a>--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        <img src="{{ asset('storage/images/players/'. $player->id .'/original.jpg')}}"--}}
{{--                             width="50">--}}
{{--                    </td>--}}
{{--                    <td>{{$player->created_at}}</td>--}}
{{--                    <td>--}}
{{--                        <form action="{{url('/admin/player/'. $player->id)}}" method="post" style="display:inline">--}}
{{--                            @csrf--}}
{{--                            @method('DELETE')--}}
{{--                            <input type="submit" value="削除" class="btn btn-delete btn-danger" onclick="return confirm('削除しますか？')">--}}
{{--                        </form>--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        <a href="{{url('/admin/player/'.$player->id.'/edit')}}" class="btn btn-warning">編集</a>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    </div>--}}
{{--@endsection--}}
