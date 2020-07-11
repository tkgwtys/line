@extends('layouts.admin')

@section('content')
    <div class="container">
{{--        {{ Breadcrumbs::render('admin.course.create') }}--}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{Form::open(['url' => '/admin/note'])}}
        @csrf
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label>ユーザー名</label>
                    {{Form::input('text', 'name',old('name'),['class' => 'form-control form-control-lg', 'placeholder' => $user->sei, 'disabled'])}}
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label>ユーザーID</label>
                    {{Form::input('text', 'user_id',old('user_id'),['class' => 'form-control form-control-lg', 'placeholder' => $user->id,'disabled'])}}
                    {{Form::hidden('user_id',$user->id)}}
                    {{Form::hidden('admin_id',$admin->id)}}
                    {{Form::hidden('course_id','test')}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label>ノート</label>
                    {{Form::textarea('note_contents',old('note_contents'), ['class' => 'form-control form-control-lg', 'size' => '30x5', 'placeholder' => 'ノートを入力してください。'])}}
                </div>
            </div>
        </div>
        {{Form::submit('登録',['class'=> 'btn btn-primary'])}}
        {{Form::close()}}
    </div>
@endsection
