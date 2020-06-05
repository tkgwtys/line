@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card" style="width: 18rem;">
            @if ($user->pictureUrl)
                <img src="{{$user->pictureUrl}}" height="300">
            @else
                <svg class="bd-placeholder-img card-img-top" width="100%" height="180"
                     xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false"
                     role="img"
                     aria-label="Placeholder: Image cap"><title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#868e96"/>
                    <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
                </svg>
            @endif
            <div class="card-body">
                <h5 class="card-title">{{$user->name}}</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">登録日：{{$user->created_at}}</li>
                <li class="list-group-item">ブロック日：{{$user->blocked_at}}</li>
            </ul>
            <div class="card-body">
                <a href="#" class="card-danger">ブロックする</a>
            </div>
        </div>
    </div>
@endsection
