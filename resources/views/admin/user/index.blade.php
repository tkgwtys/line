@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>フレンド管理</h1>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">画像</th>
                <th scope="col">表示名</th>
                <th scope="col">登録日</th>
                <th scope="col">ブロック日</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row"><a href="/admin/user/{{$user->id}}">{{$user->id}}</a></th>
                    <td><img src="{{$user->pictureUrl}}" width="50"></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->blocked_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
