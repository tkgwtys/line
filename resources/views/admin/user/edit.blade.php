@extends('layouts.admin')

@section('content')
    <div class="container">
    {{Breadcrumbs::render('adminUser.edit', $user)}}
    <!-- フラッシュメッセージ -->
        @if (session('flash_message'))
            <div class="alert alert-success" role="alert">
                {{ session('flash_message') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('admin.user.update',$user->id)}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label>姓</label>
                        {{Form::input('text', 'sei',$user->sei,['class' => 'form-control'])}}
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label>名</label>
                        {{Form::input('text', 'mei',$user->mei,['class' => 'form-control'])}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label>せい</label>
                        {{Form::input('text', 'sei_hira',$user->sei_hira,['class' => 'form-control'])}}
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label>めい</label>
                        {{Form::input('text', 'mei_hira',$user->mei_hira,['class' => 'form-control'])}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label>Email</label>
                        {{Form::input('text', 'email', $user->email,['class' => 'form-control'])}}
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label>電話番号</label>
                        {{Form::input('text', 'tel',$user->tel,['class' => 'form-control'])}}
                    </div>
                </div>
            </div>
            <!-- 時間 -->
            <div class="form-group">
                <label>レベル</label>
                <select class="form-control" id="selected_time" name="level">
                    @foreach($user_level as $key => $level)
                        <option @if($user->level == $key) selected @endIf value="{{$key}}">{{$level}}</option>
                    @endforeach
                </select>
            </div>
            <!-- 時間 -->
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>自己紹介(40文字以内）</label>
                        {{Form::textarea('self_introduction',$user->self_introduction, ['class' => 'form-control', 'size' => '30x5'])}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label>トレーナープロフィール画像</label><br>
                        <img src="{{ asset('storage/images/users/'. $user->id .'/original.jpg') . '?' . time() }}"
                             width="300">
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
