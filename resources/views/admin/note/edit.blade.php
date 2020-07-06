@extends('layouts.admin')

@section('content')
    <div class="container">
{{--        {{ Breadcrumbs::render('admin.course.create') }}--}}
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
        {{Form::open(['url' => '/admin/note/'.$note->id])}}
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label>ノート</label>
                    {{Form::textarea('note_contents',$note->note_contents, ['class' => 'form-control form-control-lg', 'size' => '30x5'])}}
                </div>
            </div>
        </div>
        {{Form::hidden('_method','patch')}}
        {{Form::submit('登録',['class'=> 'btn btn-primary'])}}
        {{Form::close()}}
    </div>
@endsection
