@extends('layouts.app')

@section('content')

                    <div class="card-header">QRコード</div>
                    <img src="{{$qr_code}}">
                    <p>ここから登録してください</p>


@endsection
