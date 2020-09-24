@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('userUserEdit') }}
        <p>{{$user->sei}}{{$user->mei}}さん、こんにちは。</p>
        <a href="/reservation" class="btn btn-primary btn-block btn-lg">予約確認・キャンセル</a>
        <a href="/user/edit" class="btn btn-primary btn-block btn-lg">アカウント設定</a>
    </div>
@endsection
