@extends('layouts.admin')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('admin.home') }}
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <a href="/admin/player" class="btn btn-primary btn-block btn-lg">トレーナ管理</a>
                <a href="/admin/user" class="btn btn-primary btn-block btn-lg">フレンド管理</a>
                <a href="/admin/course" class="btn btn-primary btn-block btn-lg">コース管理</a>
            </div>
        </div>
    </div>
@endsection
