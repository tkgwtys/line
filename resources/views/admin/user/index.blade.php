@extends('layouts.admin')
@inject('userModel', 'App\Models\User')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('adminUser') }}
        <table class="table table-striped">
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <snap style="font-weight: bold">
                            <a href="/admin/user/{{$user->id}}">{{$user->display_name}}</a>
                        </snap>
                        <img src="{{$user->picture_url}}" width="30">
                        <img src="{{asset('storage/images/users/'. $user->id .'/original.jpg')}}" width="30">
                    </td>
{{--                    <td>{{$userModel->getLevel($user->level)}}</td>--}}
{{--                    <td>{{$user->created_at}}</td>--}}
{{--                    @if($user->level === 10)--}}
{{--                    <td align="right">--}}
{{--                        <a href="{{url('admin/note/'.$user->id.'/post')}}" class="btn btn-primary">新規ノート</a>--}}
{{--                        <a href="{{url('admin/note/'.$user->id)}}" class="btn btn-warning">ノート一覧</a>--}}
{{--                    </td>--}}
{{--                    @else--}}
{{--                        <td>--}}
{{--                        </td>--}}
{{--                    @endif--}}
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
