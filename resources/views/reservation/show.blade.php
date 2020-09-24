@extends('layouts.app')
@section('content')
    <div class="table-responsive-sm">
        <table class="table table-bordered reservation" id="reservation_user_table">
            <thead>
            <tr>
                <th scope="col">前</th>
                @foreach($days_array_format as $day)
                    <th scope="col">{{$day[1]}}<br>{{$day[0]}}</th>
                @endforeach
                <th scope="col">次</th>
            </tr>
            </thead>
            <tbody>
            @foreach($time_array as $key => $time)
                @foreach($time as $hi)
                    <tr>
                        <td>{{$hi}}</td>
                        @for($i = 0; $i < $max_day ; $i++)
                            @php $var = '○'; @endphp
                            <td data-date="{{$days_array[$i]}} {{$hi}}">
                                @foreach($reservations as $reservation)
                                    @if($reservation->reserved_at == $days_array[$i] . ' ' . $hi . ':00')
                                        @php $var = '☓'; @endphp
                                        @break
                                    @endif
                                @endforeach
                                <span style="width: 100%; height: 100%" >{{$var}}</span>
                            </td>
                        @endfor
                        <td>{{$hi}}</td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
    <!----------
    モーダル
    ------------>
    <div
        class="modal modal-fullscreen"
        id="modalLarge"
        tabindex="-1"
        role="dialog"
        aria-labelledby="modalLargeLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="reservation_form_user" method="post" action="/reservation">
                    <input type="hidden" name="player_id" id="player_id" value="{{$player_id}}">
                    @csrf
                    <input type="hidden" name="status" value="30">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLargeLabel">
                            予約申請
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="store">トレーナー</label><br>
                            <img src="{{ asset('storage/images/users/'. $player->id .'/original.jpg'). '?' . time() }}"
                                 width="50">
                            <p>{{$player->sei}} {{$player->mei}}</p>
                        </div>
                        <div class="form-group">
                            <label for="store">予約申請日</label>
                            <div id="reservationDateView"></div>
                            <input type="hidden" value="" id="reservationDate" name="reservationDate">
                        </div>
                        <!-- 店舗 -->
                        <div class="form-group">
                            <label for="store">店舗</label>
                            <select class="form-control form-control-lg" id="store" name="store">
                                @foreach($stores as $key => $store)
                                    <option value="{{$store->id}}">{{$store->name}}</option>
                                @endforeach
                            </select>
                            <div
                                id="err_store"
                                class="alert alert-danger"
                                role="alert"
                                style="display: none">
                            </div>
                        </div>
                        <!-- コース -->
                        <div class="form-group">
                            <label for="course">コース</label>
                            <select class="form-control form-control-lg" id="course" name="course">
                                @foreach($courses as $key => $course)
                                    <option
                                        value="{{$course->id}}">
                                        {{$course->name}}（{{$course->course_time}}分）
                                    </option>
                                @endforeach
                            </select>
                            <div
                                id="err_course"
                                class="alert alert-danger"
                                role="alert"
                                style="display: none">
                            </div>
                        </div>
                        <!-- コース -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                            <input type="hidden" id="reservation_id_delete" value="">
                            {{--                <button type="button" id="btnTestSaveLarge" class="btn btn-default">--}}
                            {{--                    <span class="d-none d-md-inline">Save changes</span>--}}
                            {{--                    <span class="d-md-none">Save</span>--}}
                            {{--                </button>--}}
                            <button type="submit" class="btn btn-success" id="reservationButton"
                                    name="reservationButton">
                        <span
                            class="spinner-border spinner-border-sm"
                            role="status"
                            aria-hidden="true">
                        </span>予約申請
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

{{--@extends('layouts.admin')--}}
{{--@section('content')--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                <div id="alert_message"></div>--}}
{{--                <button--}}
{{--                    data-toggle="modal"--}}
{{--                    data-target="#reservationDirectly"--}}
{{--                    type="button"--}}
{{--                    class="btn btn-primary btn-lg btn-block">予約する--}}
{{--                </button>--}}
{{--                <br>--}}
{{--                <div style="text-align: center; ">--}}
{{--                    <img width="200"--}}
{{--                         style="border-radius: 50%;width: 180px;height: 180px;"--}}
{{--                         src="{{$player->image . '?' . time()}}"--}}
{{--                         alt="Card image cap">--}}
{{--                </div>--}}
{{--                <br>--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <h5 class="card-title">--}}
{{--                            {{$player->sei}}{{$player->mei}}（{{$player->sei_hira}}{{$player->mei_hira}}）--}}
{{--                        </h5>--}}
{{--                        <p class="card-text">{{$player->self_introduction}}</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <br>--}}
{{--                <button--}}
{{--                    data-toggle="modal"--}}
{{--                    data-target="#reservationDirectly"--}}
{{--                    type="button"--}}
{{--                    class="btn btn-primary btn-lg btn-block">予約する--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- Modal -->--}}
{{--    <div--}}
{{--        class="modal"--}}
{{--        id="reservationDirectly"--}}
{{--        tabindex="-1"--}}
{{--        role="dialog"--}}
{{--        aria-labelledby="exampleModalLongTitle"--}}
{{--        aria-hidden="true">--}}
{{--        <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="exampleModalLongTitle">予約申請</h5>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                @if($user->sei && $user->mei)--}}
{{--                    <div class="modal-body">--}}
{{--                        <form id="reservation_form" method="post" action="/reservation">--}}
{{--                            @csrf--}}
{{--                            <input type="hidden" name="status" value="10">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="reservation_day">予約日</label>--}}
{{--                                        <input--}}
{{--                                            id="reservation_day"--}}
{{--                                            value="{{$tomorrow}}"--}}
{{--                                            class="selector form-control form-control-lg"--}}
{{--                                            type="text"/>--}}
{{--                                    </div>--}}
{{--                                    <input type="hidden" value="{{$tomorrow}}" id="selected_date" name="selected_date">--}}
{{--                                    <input type="hidden" value="{{$user_id}}" id="user" name="user">--}}
{{--                                </div>--}}
{{--                                <div class="col">--}}
{{--                                    <!-- 時間 -->--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="selected_time">予約時間</label>--}}
{{--                                        <select class="form-control form-control-lg" id="selected_time"--}}
{{--                                                name="selected_time">--}}
{{--                                            @foreach($time_array as $key => $time)--}}
{{--                                                <optgroup label="{{$key}}">--}}
{{--                                                    @foreach($time as $hi)--}}
{{--                                                        <option value="{{$hi}}:00">{{$hi}}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                </optgroup>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <!-- 時間 -->--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- トレーナ -->--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="player">担当トレーナ</label>--}}
{{--                                <select class="form-control form-control-lg" id="player" name="player">--}}
{{--                                    <option value="0">選択してください</option>--}}
{{--                                    @foreach($player_array as $key => $player)--}}
{{--                                        <option value="{{$player->id}}"--}}
{{--                                                @if($player_id == $player->id) selected @endif>{{$player->sei}} {{$player->mei}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                <div--}}
{{--                                    id="err_player"--}}
{{--                                    class="alert alert-danger"--}}
{{--                                    role="alert"--}}
{{--                                    style="display: none">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- トレーナ -->--}}
{{--                            <!-- 店舗 -->--}}
{{--                            <div class="form-group">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="store">店舗</label>--}}
{{--                                    <select class="form-control form-control-lg" id="store" name="store">--}}
{{--                                        <option value="0">選択してください</option>--}}
{{--                                        @foreach($stores as $key => $store)--}}
{{--                                            <option value="{{$store->id}}">{{$store->name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    <div--}}
{{--                                        id="err_store"--}}
{{--                                        class="alert alert-danger"--}}
{{--                                        role="alert"--}}
{{--                                        style="display: none"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- コース -->--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="course">コース</label>--}}
{{--                                <select class="form-control form-control-lg" id="course" name="course">--}}
{{--                                    <option value="0">選択してください</option>--}}
{{--                                    @foreach($courses as $key => $course)--}}
{{--                                        <option--}}
{{--                                            value="{{$course->id}}">--}}
{{--                                            {{$course->name}}（{{$course->course_time}}分）--}}
{{--                                        </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                <div--}}
{{--                                    id="err_course"--}}
{{--                                    class="alert alert-danger"--}}
{{--                                    role="alert"--}}
{{--                                    style="display: none">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- コース -->--}}
{{--                            <!-- トレーナ -->--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-header">--}}
{{--                                    お客様情報--}}
{{--                                </div>--}}
{{--                                <div class="card-body">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="sei"></label>姓--}}
{{--                                                <input--}}
{{--                                                    type="text"--}}
{{--                                                    class="form-control form-control-lg"--}}
{{--                                                    id="sei"--}}
{{--                                                    name="sei"--}}
{{--                                                    placeholder="姓を入力してください"--}}
{{--                                                    value="{{$user->sei}}">--}}
{{--                                                <div--}}
{{--                                                    id="err_sei"--}}
{{--                                                    class="alert alert-danger"--}}
{{--                                                    role="alert"--}}
{{--                                                    style="display: none"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="mei"></label>名--}}
{{--                                                <input--}}
{{--                                                    type="text"--}}
{{--                                                    class="form-control form-control-lg"--}}
{{--                                                    name="mei"--}}
{{--                                                    id="mei"--}}
{{--                                                    placeholder="名を入力してください"--}}
{{--                                                    value="{{$user->mei}}">--}}
{{--                                                <div--}}
{{--                                                    id="err_mei"--}}
{{--                                                    class="alert alert-danger"--}}
{{--                                                    role="alert"--}}
{{--                                                    style="display: none"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="modal-footer">--}}
{{--                                <button--}}
{{--                                    type="submit"--}}
{{--                                    class="btn btn-success btn-block btn-lg">--}}
{{--                                <span--}}
{{--                                    class="spinner-border spinner-border-sm"--}}
{{--                                    role="status"--}}
{{--                                    aria-hidden="true"></span>--}}
{{--                                    予約申請する--}}
{{--                                </button>--}}
{{--                                <br>--}}
{{--                                <br>--}}
{{--                                <br>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                @else--}}
{{--                    <div class="modal-body">--}}
{{--                        <h3>ご予約するには「お客様情報」を登録する必要があります。</h3>--}}
{{--                        <a class="btn btn-primary btn-lg btn-block" href="/user/edit">入力フォームへ</a>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
