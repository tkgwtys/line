@extends('layouts.app')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('userReservationEnd') }}
        <h2>予約申請しました。</h2>
        <p class="text-danger">本予約ではございません。改めてトレーナからご連絡致します。</p>
        <a href="/reservation/{{$player_id}}" class="btn btn-primary btn-block btn-lg">続けて同じトレーナーで予約する</a>
        <a href="/player" class="btn btn-primary btn-block btn-lg">別のトレーナーで予約する</a>
        <a href="/reservation" class="btn btn-primary btn-block btn-lg">予約確認・キャンセル</a>
    </div>
@endsection
