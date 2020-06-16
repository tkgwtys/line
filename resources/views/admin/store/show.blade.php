@extends('layouts.admin')
@inject('courseModel', 'App\Models\Course')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('adminCourse', $store) }}
        <table class="table table-bordered">
            <tbody>
            <tr>
                <th style="width: 35%;">コース名</th>
                <td>{{$store->name}}</td>
            </tr>
            <tr>
                <th>住所</th>
                <td>{{$store->address}}</td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>{{$store->tel}}</td>
            </tr>
            <tr>
                <th>URL</th>
                <td>
                    <a href="{{$store->url}}">
                        {{$store->url}}
                    </a>
                </td>
            </tr>
            <tr>
                <th>営業時間</th>
                <td>{{$store->business_hours}}</td>
            </tr>
            <tr>
                <th>カラーコード</th>
                <td>{{$store->color_code}}</td>
            </tr>
            </tbody>
        </table>
        <a class="btn btn-primary btn-lg btn-block" href="{{url('/admin/store/'.$store->id.'/edit')}}" role="button">編集</a>
    </div>
@endsection
