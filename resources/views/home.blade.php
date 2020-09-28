@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('userHome') }}
        <p>{{$user->sei}}{{$user->mei}}さん、こんにちは。</p>
        <a href="/player" class="btn btn-primary btn-block btn-lg">予約する</a>
        <a href="/reservation" class="btn btn-primary btn-block btn-lg">予約確認・キャンセル</a>
        <a href="/user/edit" class="btn btn-primary btn-block btn-lg">アカウント設定</a>
    </div>
@endsection
