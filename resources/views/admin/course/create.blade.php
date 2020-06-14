@extends('layouts.admin')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('admin.course.create') }}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{Form::open(['url' => '/admin/course'])}}
        @csrf
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label>コース名</label>
                    {{Form::input('text', 'name',old('name'),['class' => 'form-control form-control-lg', 'placeholder' => 'コース名を入力してください'])}}
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label>価格（円）</label>
                    {{Form::input('tel', 'price',old('price'),['class' => 'form-control form-control-lg', 'id'=>'price', 'onblur'=>'calculate();', 'placeholder' => '価格を入力してください'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label>コース回数/月</label>
                    {{Form::input('tel', 'month_count',old('month_count'),['class' => 'form-control form-control-lg', 'id'=>'month_count','onblur'=>'calculate();' ,'placeholder' => 'コース回数を入力してください'])}}
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label>コース時間</label>
                    {{Form::input('tel', 'course_time',old('course_time'),['class' => 'form-control form-control-lg', 'id'=>'course_time','placeholder' => 'コース時間を入力してください'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label>合計金額</label>
                    {{Form::input('int', 'total_price',old('total_price'),['class' => 'form-control form-control-lg', 'id'=>'total_price','disabled'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label>コース説明</label>
                    {{Form::textarea('description',old('description'), ['class' => 'form-control form-control-lg', 'size' => '30x5', 'placeholder' => 'コース詳細を入力してください'])}}
                </div>
            </div>
        </div>
        {{Form::submit('登録',['class'=> 'btn btn-primary'])}}
        {{Form::close()}}
    </div>
@endsection
