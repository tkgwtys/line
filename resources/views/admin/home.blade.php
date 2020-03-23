@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        管理画面
                        <a href="/admin/super_user" class="btn btn-primary btn-sm">トレーナ管理</a>
                        <a href="/admin/user" class="btn btn-primary btn-sm">フレンド管理</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
