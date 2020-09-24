@extends('layouts.admin')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('adminHome') }}
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <a href="/admin/schedule" class="btn btn-primary btn-block btn-lg">スケジュール管理（全体）</a>
                <a href="/admin/player" class="btn btn-primary btn-block btn-lg">トレーナー管理</a>
                <a href="/admin/user" class="btn btn-primary btn-block btn-lg">フレンド管理</a>
                <a href="/admin/course" class="btn btn-primary btn-block btn-lg">コース管理</a>
                <a href="/admin/store" class="btn btn-primary btn-block btn-lg">店舗管理</a>
            </div>
        </div>
    </div>
@endsection
