@extends('layouts.admin')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('adminStores') }}
        <p>
            <a href="{{url('/admin/store/create')}}" class="btn btn-primary">ストア登録</a>
        </p>
        <table class="table table-striped">
            <thead>
            <tr>
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
                    <td align="right">
                        <a href="{{url('/admin/store/'.$store->id.'/edit')}}" class="btn btn-warning">編集</a>
                        <form action="{{url('/admin/store/'. $store->id)}}" method="post" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="削除" class="btn btn-delete btn-danger" onclick="return confirm('削除しますか？')">
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
