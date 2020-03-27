@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">管理画面トップ</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="/admin/player" class="btn btn-primary">トレーナ管理</a>
                        <a href="/admin/user" class="btn btn-primary">フレンド管理</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
