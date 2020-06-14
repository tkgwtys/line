@extends('layouts.admin')

@section('content')
        {{Breadcrumbs::render('adminStore.edit', $store)}}
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
        <form action="{{route('store.update', $store->id)}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label>コース名</label>
                        {{Form::input('text', 'name',$store->name,['class' => 'form-control'])}}
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label>住所</label>
                        {{Form::input('text', 'address',$store->address,['class' => 'form-control'])}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label>電話番号</label>
                        {{Form::input('int', 'tel',$store->tel,['class' => 'form-control'])}}
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label>URL</label>
                        {{Form::input('text', 'url',$store->url,['class' => 'form-control'])}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label>営業時間</label>
                        {{Form::input('text','business_hours', $store->business_hours,['class' => 'form-control' ])}}
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label>カラーコード</label>
                        {{Form::input('text','color_code', $store->color_code,['class' => 'form-control' ])}}
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
