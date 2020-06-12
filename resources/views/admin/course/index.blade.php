@extends('layouts.admin')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('adminCourses') }}
        <h1>コース管理</h1>
        <p>
            <a href="{{url('/admin/course/create')}}" class="btn btn-primary">コース登録</a>
        </p>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">コース名</th>
                <th scope="col">価格</th>
            </tr>
            </thead>
            <tbody>
            @foreach($courses as $course)
                <tr>
                    <td>
                        <a href="{{url('/admin/course/'. $course->id)}}">
                            {{$course->name}}
                        </a>
                    </td>
                    <td>
                        {{number_format($course->price)}}円
                    </td>
                    <td align="right">
                        <form action="{{url('/admin/course/'. $course->id)}}" method="post" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="削除" class="btn btn-delete btn-danger" onclick="return confirm('削除しますか？')">
                        </form>
                        <a href="{{url('/admin/course/'.$course->id.'/edit')}}" class="btn btn-warning">編集</a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
