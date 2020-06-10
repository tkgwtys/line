@extends('layouts.admin')
@inject('courseModel', 'App\Models\Course')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('adminCourse', $course) }}
        <table class="table table-bordered">
            <tbody>
            <tr>
                <th style="width: 35%;">コース名</th>
                <td>{{$course->name}}</td>
            </tr>
            <tr>
                <th>価格</th>
                <td>{{$course->price}}</td>
            </tr>
            <tr>
                <th>コース回数/月</th>
                <td>{{$course->month_count}}</td>
            </tr>
            <tr>
                <th>合計価格</th>
                <td>{{$course->total_price}}</td>
            </tr>
            <tr>
                <th>コース時間</th>
                <td>{{$course->course_time}}</td>
            </tr>
            <tr>
                <th>コース説明</th>
                <td>{{$course->description}}</td>
            </tr>
            <tr>
                <th>登録日</th>
                <td>{{$course->created_at}}</td>
            </tr>
            </tbody>
        </table>
        <a class="btn btn-primary btn-lg btn-block" href="{{url('/admin/course/'.$course->id.'/edit')}}" role="button">編集</a>
    </div>
@endsection
