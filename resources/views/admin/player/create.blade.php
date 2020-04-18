@extends('layouts.admin')

@section('content')
    <div class="container">
        <nav aria-label="パンくずリスト">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/home')}}">ホーム</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/player')}}">トレーナ管理</a></li>
                <li class="breadcrumb-item active" aria-current="page">トレーナ登録</li>
            </ol>
        </nav>
        <h1>トレーナ登録</h1>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{Form::open(['url' => '/admin/player', 'files' => true])}}
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label>姓</label>
                    {{Form::input('text', 'sei',old('sel'),['class' => 'form-control', 'placeholder' => '姓を入力してください'])}}
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label>名</label>
                    {{Form::input('text', 'mei',old('mei'),['class' => 'form-control', 'placeholder' => '名を入力してください'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label>せい</label>
                    {{Form::input('text', 'sei_hira',old('sei_hira'),['class' => 'form-control', 'placeholder' => 'せいを入力してください'])}}
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label>めい</label>
                    {{Form::input('text', 'mei_hira',old('mei_hira'),['class' => 'form-control', 'placeholder' => 'めいを入力してください'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label>プロフィール画像</label>
                    {{Form::input('file', 'image',null,['class' => 'form-control-file'])}}
                    <small id="imageHelp" class="form-text text-muted">対応拡張子：jpeg,png,jpg</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label>プロフィール内容</label>
                    {{Form::textarea('self_introduction',old('self_introduction'), ['class' => 'form-control', 'size' => '30x5'])}}
                </div>
            </div>
        </div>
        {{Form::submit('保存する',['class'=> 'btn btn-primary'])}}
        {{Form::close()}}
    </div>
@endsection
