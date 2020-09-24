@extends('layouts.admin')

@section('content')
    <div class="container">
    {{Breadcrumbs::render('adminCourseEdit', $course)}}
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
        <form action="{{route('course.update',$course->id)}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label>コース名</label>
                        {{Form::input('text', 'name',$course->name,['class' => 'form-control form-control-lg'])}}
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label>価格（円）</label>
                        {{Form::input('tel', 'price',$course->price,['class' => 'form-control form-control-lg', 'id' => 'price', 'onblur' => 'calculate();'])}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label>コース回数/月</label>
                        {{Form::input('tel', 'month_count',$course->month_count,['class' => 'form-control form-control-lg', 'id' => 'month_count', 'onblur'=>'calculate();'])}}
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label>コース時間</label>
                        {{Form::input('tel', 'course_time',$course->course_time,['class' => 'form-control form-control-lg','id'=>'course_time'])}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label>合計金額</label>
                        {{Form::input('int', 'total_price',$course->total_price,['class' => 'form-control form-control-lg', 'id' => 'total_price', 'disabled'])}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label>コース説明</label>
                        {{Form::textarea('description', $course->description,['class' => 'form-control form-control-lg' ])}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <input type="hidden" name="_method" value="patch">
                        <input type="submit" class="btn btn-primary" value="更新">
                    </div>
                </div>
            </div>
        </form>
@endsection
