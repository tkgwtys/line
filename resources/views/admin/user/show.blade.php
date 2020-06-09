@extends('layouts.admin')
@inject('userModel', 'App\Models\User')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('adminUser', $user) }}
        <table class="table table-bordered">
            <tbody>
            <tr>
                <th style="width: 35%;">表示名</th>
                <td>{{$user->display_name}}</td>
            </tr>
            <tr>
                <th>名前</th>
                <td>{{$user->sei}}{{$user->mei}}</td>
            </tr>
            <tr>
                <th>ランク</th>
                <td>{{$userModel->getLevel($user->level)}}</td>
            </tr>
            <tr>
                <th>自己紹介</th>
                <td>{{$user->self_introduction}}</td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>{{$user->tel}}</td>
            </tr>
            <tr>
                <th>メールドレス</th>
                <td>{{$user->email}}</td>
            </tr>
            <tr>
                <th>登録日</th>
                <td>{{$user->created_at}}</td>
            </tr>
            <tr>
                <th>ブロック日</th>
                <td>{{$user->blocked_at}}</td>
            </tr>
            </tbody>
        </table>
        <a class="btn btn-primary btn-lg btn-block" href="{{url('/admin/user/'.$user->id.'/edit')}}" role="button">編集</a>
    </div>
@endsection
