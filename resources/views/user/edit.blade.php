@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- フラッシュメッセージ -->
        @if (session('flash_message'))
            <div class="alert alert-success" role="alert">
                <strong>{{ session('flash_message') }}</strong>
            </div>
        @endif
        <form action="{{route('user.update')}}" enctype="multipart/form-data" method="post">
            @method('PUT')
            @csrf
            <input type="hidden" name="_method" value="put">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="sei">姓</label>
                        <input
                            id="sei"
                            type="text"
                            class="form-control form-control-lg @error('name') is-invalid @enderror"
                            name="sei" value="{{$user->sei}}"
                            required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="mei">名</label>
                        <input id="mei" type="text"
                               class="form-control form-control-lg @error('name') is-invalid @enderror"
                               name="mei"
                               value="{{$user->mei}}"
                               required
                               autocomplete="name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="sei_hira">せい</label>
                        <input id="sei_hira"
                               type="text"
                               class="form-control form-control-lg @error('name') is-invalid @enderror"
                               name="sei_hira"
                               value="{{$user->sei_hira}}"
                               required
                               autocomplete="name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="mei_hira">めい</label>
                        <input id="mei_hira" type="text"
                               class="form-control form-control-lg @error('name') is-invalid @enderror"
                               name="mei_hira"
                               value="{{$user->mei_hira}}"
                               required
                               autocomplete="name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="tel">電話番号</label>
                <input
                    id="tel"
                    type="tel"
                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                    name="tel"
                    value="{{$user->tel}}"
                    required
                    autocomplete="tel">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input id="email"
                       type="email"
                       class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
                       value="{{$user->email}}"
                       required
                       autocomplete="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">保存</button>
        </form>
    </div>
@endsection
