@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <button data-toggle="modal" data-target="#reservation" type="button"
                        class="btn btn-primary btn-lg btn-block">予約する
                </button>
                <br>
                <div class="card">
                    <span class="card-avatar-back"></span>
                    <img class="card-img-top card-header-img"
                         src="{{$player->image . '?' . time()}}"
                         alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{$player->id}}
                            {{$player->sei}}{{$player->mei}}（{{$player->sei_hira}}{{$player->mei_hira}}）
                        </h5>
                        <p class="card-text">{{$player->self_introduction}}</p>
                    </div>
                </div>
                <br>
                <button
                    data-toggle="modal"
                    data-target="#reservation"
                    type="button"
                    class="btn btn-primary btn-lg btn-block">予約する
                </button>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div
        class="modal"
        id="reservation"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">予約申請</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="reservation_form" method="post" action="/reservation/store">
                        @csrf
                        <div class="form-group">
                            <label for="reservation_day">予約日</label>
                            <input id="reservation_day" value="{{$tomorrow}}" class="selector form-control"
                                   type="text"/>
                        </div>
                        <input type="hidden" value="{{$tomorrow}}" id="selected_date" name="selected_date">
                        <input type="hidden" value="{{$user_id}}" id="user_id" name="user_id">
                        <input type="hidden" value="{{$player->id}}" id="player_id" name="player_id">
                        <!-- 時間 -->
                        <div class="form-group">
                            <label for="selected_time">予約時間</label>
                            <select class="form-control" id="selected_time" name="selected_time">
                                @foreach($time_array as $key => $time)
                                    <optgroup label="{{$key}}">
                                        @foreach($time as $hi)
                                            <option value="{{$hi}}">{{$hi}}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                        <!-- 時間 -->
                        <!-- トレーナ -->
                        <div class="form-group">
                            <label>担当トレーナ</label>
                        </div>
                        <!-- トレーナ -->
                        <div class="card">
                            <div class="card-header">
                                お客様
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="col-form-label">お名前</label>
                                    <label for="reservation_user"></label><input
                                        disabled
                                        type="text"
                                        class="form-control"
                                        id="reservation_user"
                                        placeholder="予約者"
                                        value="{{$user->sei}}{{$user->mei}}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                            <button type="submit" class="btn btn-success">予約申請する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
