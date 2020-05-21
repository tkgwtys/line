@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <!-- フラッシュメッセージ -->
                @if (session('flash_message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('flash_message') }}
                    </div>
                @endif

                <div class="card-body">
                    <form action="{{route('line-user.update',$user->id)}}" enctype = "multipart/form-data" method="post" >

                        @csrf
                        <input type="hidden" name="_method" value="put">
                        <div class="form-group row">
                            <label for="sei" class="col-md-4 col-form-label text-md-right">姓</label>

                            <div class="col-md-6">
                                <input id="sei" type="text" class="form-control @error('name') is-invalid @enderror" name="sei" value="<?= $user->sei ?>" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mei" class="col-md-4 col-form-label text-md-right">名</label>

                            <div class="col-md-6">
                                <input id="mei" type="text" class="form-control @error('name') is-invalid @enderror" name="mei" value="<?= $user->mei ?>" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sei_hira" class="col-md-4 col-form-label text-md-right">せい（ふりがな）</label>

                            <div class="col-md-6">
                                <input id="sei_hira" type="text" class="form-control @error('name') is-invalid @enderror" name="sei_hira" value="<?= $user->sei_hira ?>" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mei_hira" class="col-md-4 col-form-label text-md-right">めい（ふりがな）</label>

                            <div class="col-md-6">
                                <input id="mei_hira" type="text" class="form-control @error('name') is-invalid @enderror" name="mei_hira" value="<?= $user->mei_hira ?>" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">電話番号</label>

                            <div class="col-md-6">
                                <input id="tel" type="tel" class="form-control @error('email') is-invalid @enderror" name="tel" value="<?= $user->tel ?>" required autocomplete="tel">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="<?= $user->email ?>" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">パスワード</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">パスワード確認</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}


                        <div class="form-group row mb-0">

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    登録
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
