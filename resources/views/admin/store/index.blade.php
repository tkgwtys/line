@extends('layouts.admin')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('adminStores') }}
        <h1>ストア管理</h1>
        <p>
            <a href="{{url('/admin/store/create')}}" class="btn btn-primary">ストア登録</a>
        </p>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">ストア名</th>
                <th scope="col">住所</th>
                <th scope="col">電話番号</th>
                <th scope="col">HP</th>
            </tr>
            </thead>
            <tbody>
            @foreach($stores as $store)
                <tr>
                    <td>
                        <a href="{{url('/admin/store/'. $store->id)}}">
                            {{$store->name}}
                        </a>
                    </td>
                    <td>
                        {{$store->address}}
                    </td>
                    <td>
                        {{$store->tel}}
                    </td>
                    <td>
                        <a href="{{$store->url}}">
                        {{$store->url}}
                        </a>
                    </td>
                    <td>
                        <form action="{{url('/admin/store/'. $store->id)}}" method="post" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="削除" class="btn btn-delete btn-danger" onclick="return confirm('削除しますか？')">
                        </form>
                    </td>
                    <td>
                        <a href="{{url('/admin/store/'.$store->id.'/edit')}}" class="btn btn-warning">編集</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
