@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>トレーナ登録</h1>
        {{Form::open(['url' => '/admin/player', 'files' => true])}}
        <div class="row">
            <div class="col-sm">
                <label>姓</label>
                {{Form::input('text', 'sei',null,['class' => 'form-control', 'placeholder' => '姓を入力してください'])}}
            </div>
            <div class="col-sm">
                <label>名</label>
                {{Form::input('text', 'mei',null,['class' => 'form-control', 'placeholder' => '名を入力してください'])}}
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <label>せい</label>
                {{Form::input('text', 'sei_hira',null,['class' => 'form-control', 'placeholder' => 'せいを入力してください'])}}
            </div>
            <div class="col-sm">
                <label>めい</label>
                {{Form::input('text', 'mei_hira',null,['class' => 'form-control', 'placeholder' => 'めいを入力してください'])}}
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <label>プロフィール画像</label>
                {{Form::input('file', 'image',null,['class' => 'form-control-file'])}}
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label>プロフィール内容</label>
                {{Form::textarea('self_introduction',null, ['class' => 'form-control', 'size' => '30x5'])}}
            </div>
        </div>
        {{Form::submit('保存する',['class'=> 'btn btn-primary'])}}
        {{Form::close()}}

        {{--        <form method="post" action="/admin/player" enctype="multipart/form-data">--}}
        {{--            {{ csrf_field() }}--}}
        {{--            <div class="form-group">--}}
        {{--                <label for="exampleInputEmail1">性</label>--}}
        {{--                <input--}}
        {{--                    type="text"--}}
        {{--                    name="sei"--}}
        {{--                    class="form-control"--}}
        {{--                    id="exampleInputEmail1"--}}
        {{--                    aria-describedby="emailHelp"--}}
        {{--                    placeholder="性を入力してください">--}}
        {{--            </div>--}}
        {{--            <div class="form-group">--}}
        {{--                <label for="exampleInputPassword1">名</label>--}}
        {{--                <input--}}
        {{--                    type="text"--}}
        {{--                    name="mei"--}}
        {{--                    class="form-control"--}}
        {{--                    id="exampleInputPassword1"--}}
        {{--                    placeholder="名を入力してください">--}}
        {{--            </div>--}}
        {{--            <div class="form-group">--}}
        {{--                <label for="exampleInputEmail1">せい</label>--}}
        {{--                <input--}}
        {{--                    type="text"--}}
        {{--                    name="sei_hira"--}}
        {{--                    class="form-control"--}}
        {{--                    id="exampleInputEmail1"--}}
        {{--                    aria-describedby="emailHelp"--}}
        {{--                    placeholder="せいを入力してください">--}}
        {{--            </div>--}}
        {{--            <div class="form-group">--}}
        {{--                <label for="exampleInputPassword1">めい</label>--}}
        {{--                <input--}}
        {{--                    type="text"--}}
        {{--                    name="mei_hira"--}}
        {{--                    class="form-control"--}}
        {{--                    id="exampleInputPassword1"--}}
        {{--                    placeholder="めいを入力してください">--}}
        {{--            </div>--}}
        {{--            <div class="form-group">--}}
        {{--                <label for="exampleInputEmail1">説明</label>--}}
        {{--                <textarea--}}
        {{--                    class="form-control"--}}
        {{--                    rows="3"--}}
        {{--                    name="self_introduction"></textarea>--}}
        {{--            </div>--}}
        {{--            <div class="form-group">--}}
        {{--                <label for="exampleFormControlFile1">プロフィール画像</label>--}}
        {{--                <input--}}
        {{--                    type="file"--}}
        {{--                    name="image"--}}
        {{--                    class="form-control-file"--}}
        {{--                    id="exampleFormControlFile1">--}}
        {{--            </div>--}}
        {{--            <button type="submit" class="btn btn-primary">登録</button>--}}
        {{--        </form>--}}
    </div>
@endsection
