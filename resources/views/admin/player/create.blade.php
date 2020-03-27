@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>トレーナ登録</h1>
        <form method="post" action="/admin/player" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputEmail1">性</label>
                <input
                        type="text"
                        name="sei"
                        class="form-control"
                        id="exampleInputEmail1"
                        aria-describedby="emailHelp"
                        placeholder="性を入力してください">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">名</label>
                <input
                        type="text"
                        name="mei"
                        class="form-control"
                        id="exampleInputPassword1"
                        placeholder="名を入力してください">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">せい</label>
                <input
                        type="text"
                        name="sei_hira"
                        class="form-control"
                        id="exampleInputEmail1"
                        aria-describedby="emailHelp"
                        placeholder="せいを入力してください">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">めい</label>
                <input
                        type="text"
                        name="mei_hira"
                        class="form-control"
                        id="exampleInputPassword1"
                        placeholder="めいを入力してください">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">説明</label>
                <textarea
                        class="form-control"
                        rows="3"
                        name="self_introduction"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">プロフィール画像</label>
                <input
                        type="file"
                        name="image"
                        class="form-control-file"
                        id="exampleFormControlFile1">
            </div>
            <button type="submit" class="btn btn-primary">登録</button>
        </form>
    </div>
@endsection
