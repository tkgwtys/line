@extends('layouts.admin')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('adminStoreCreate') }}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{Form::open(['url' => '/admin/store'])}}
        @csrf
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label>ストア名</label>
                    {{Form::input('text', 'name',old('name'),['class' => 'form-control form-control-lg', 'placeholder' => 'ストア名を入力してください'])}}
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label>住所</label>
                    {{Form::input('text', 'address',old('address'),['class' => 'form-control form-control-lg', 'placeholder' => '住所を入力してください'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label>電話番号</label>
                    {{Form::input('int', 'tel',old('tel'),['class' => 'form-control form-control-lg','placeholder' => '電話番号を入力してください'])}}
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label>URL</label>
                    {{Form::input('text', 'url',old('url'),['class' => 'form-control form-control-lg', 'placeholder' => 'URLを入力してください'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label>営業時間</label>
                    {{Form::input('text','business_hours',old('business_horus'), ['class' => 'form-control form-control-lg','placeholder' => '営業時間を入力してください'])}}
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group" id="color_code">
                    <label>カラーコード</label>
                    {{Form::select('color_code',['#cce5ff' => '青','#e2e3e5' =>'灰','#d4edda'=>'緑','#f8d7da'=>'赤','#fff3cd'=>'黄','#d1ecf1'=>'薄緑'] ,null, ['class' => 'form-control form-control-lg','id'=>'select-color','onblur'=>'changeColor();','placeholder' => 'カラーコードを選択してください'])}}
                </div>
            </div>
        </div>
        {{Form::submit('登録',['class'=> 'btn btn-primary'])}}
        {{Form::close()}}
    </div>
@endsection
