@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>トレーナ編集</h1>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('player.update',$player->id)}}" method="post">
        @csrf
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label>姓</label>
                    {{Form::input('text', 'sei',$player->sei,['class' => 'form-control'])}}
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label>名</label>
                    {{Form::input('text', 'mei',$player->mei,['class' => 'form-control'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label>せい</label>
                    {{Form::input('text', 'sei_hira',$player->sei_hira,['class' => 'form-control'])}}
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label>めい</label>
                    {{Form::input('text', 'mei_hira',$player->mei_hira,['class' => 'form-control'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label>自己紹介(40文字以内）</label>
                    {{Form::textarea('self_introduction',$player->self_introduction, ['class' => 'form-control', 'size' => '30x5'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label>プロフィール画像</label><br>
                    <img src="{{ asset('storage/images/players/'. $player->id .'/original.jpg')}}" width="300">
                    {{Form::input('file', 'image',null,['class' => 'form-control-file'])}}
                    <small id="imageHelp" class="form-text text-muted">対応拡張子：jpeg,png,jpg</small>
                </div>
            </div>
        </div>
            <div>
                <input type="hidden" name="_method" value="patch">
                <input type="submit" class="btn btn-primary" value="更新">
            </div>
        </form>
    </div>
@endsection
