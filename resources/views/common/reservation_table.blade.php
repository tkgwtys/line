<div class="scroll_div">
    <div class="table-responsive">
        <a type="button" class="btn btn-primary btn-sm" href="">先週</a>
        <a type="button" class="btn btn-primary btn-sm" href="{{$today_link}}">本日</a>
        <a type="button" class="btn btn-primary btn-sm" href="">来週</a>
        <table class="table table-bordered table-sm table-hover"
               id="target-table"
               _fixedhead="rows:1; cols:2">
            <thead>
            <tr>
                <th></th>
                <th></th>
                @foreach($time_array as $key => $time)
                    @foreach($time as $hi)
                        <td>{{$hi}}</td>
                    @endforeach
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($days_array as $day)
                <tr>
                    <th rowspan="{{count($player_array)}}" class="viewDay">{{$day}}</th>
                    @foreach($player_array as $key => $player)
                        <th class="playerName">{{$player->sei}}</th>
                        @foreach($time_array as $key => $time)
                            @foreach($time as $hi)
                                @php
                                    $count = 0;
                                @endphp
                                <td colspan="{{$count}}">
                                    @foreach($reservations as $reservation)
                                        @if($day.' '.$hi.':00' == $reservation->reserved_at && $player->id == $reservation->player_id)
                                            <button
                                                type="button"
                                                class="btn btn-info reservationButton"
                                                data-toggle="modal"
                                                data-day="{{$day}}"
                                                data-player_id="{{$player->id}}"
                                                data-time="{{$hi}}:00"
                                                data-target="#modalLarge"
                                                data-course_id="{{$reservation->course_id}}"
                                                data-user_id="{{$reservation->user_id}}"
                                                data-reservation_id="{{$reservation->reservation_id}}"
                                                data-sei="{{$reservation->sei}}"
                                                data-mei="{{$reservation->mei}}"
                                                data-store_id="{{$reservation->store_id}}">
                                                {{$reservation->sei}}{{$reservation->mei}}
                                                【{{$reservation->name}}（{{$reservation->course_time}}分）】
                                            </button>
                                        @endif
                                    @endforeach
                                    <button type="button"
                                            class="btn btn-link reservationButton"
                                            data-toggle="modal"
                                            data-day="{{$day}}"
                                            data-player_id="{{$player->id}}"
                                            data-time="{{$hi}}:00"
                                            data-target="#modalLarge">
                                        <svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16"
                                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"/>
                                            <path fill-rule="evenodd"
                                                  d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"/>
                                        </svg>
                                    </button>
                                </td>
                            @endforeach
                        @endforeach
                </tr>
            @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal modal-fullscreen" id="modalLarge" tabindex="-1" role="dialog" aria-labelledby="modalLargeLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="reservation_form" method="post" action="/admin/reservation">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLargeLabel">
                        <span id="reservation_label"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="reservation_day">予約日</label>
                                <input id="reservation_day" class="selector form-control form-control-lg" type="text"/>
                            </div>
                            <input type="hidden" value="" id="selected_date" name="selected_date">
                        </div>
                        <div class="col">
                            <!-- 時間 -->
                            <div class="form-group">
                                <label for="selected_time">予約時間</label>
                                <select class="form-control form-control-lg" id="selected_time" name="selected_time">
                                    <option value="">選択してください</option>
                                    @foreach($time_array as $key => $time)
                                        <optgroup label="{{$key}}">
                                            @foreach($time as $hi)
                                                <option value="{{$hi}}:00">{{$hi}}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                <div
                                    id="err_selected_time"
                                    class="alert alert-danger"
                                    role="alert"
                                    style="display: none">
                                </div>
                            </div>
                            <!-- 時間 -->
                        </div>
                    </div>
                    <!-- トレーナ -->
                    <div class="form-group">
                        <label for="player">担当トレーナ</label>
                        <select class="form-control form-control-lg" id="player" name="player">
                            <option value="">選択してください</option>
                            @foreach($player_array as $key => $player)
                                <option value="{{$player->id}}">{{$player->sei}} {{$player->mei}}</option>
                            @endforeach
                        </select>
                        <div
                            id="err_player"
                            class="alert alert-danger"
                            role="alert"
                            style="display: none">
                        </div>
                    </div>
                    <!-- 店舗 -->
                    <div class="form-group">
                        <div class="form-group">
                            <label for="store">店舗</label>
                            <select class="form-control form-control-lg" id="store" name="store">
                                <option value="">選択してください</option>
                                @foreach($stores as $key => $store)
                                    <option value="{{$store->id}}">{{$store->name}}</option>
                                @endforeach
                            </select>
                            <div
                                id="err_store"
                                class="alert alert-danger"
                                role="alert"
                                style="display: none"></div>
                        </div>
                    </div>
                    <!-- コース -->
                    <div class="form-group">
                        <label for="course">コース</label>
                        <select class="form-control form-control-lg" id="course" name="course">
                            <option value="">選択してください</option>
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
                    <!-- トレーナ -->
                    <div class="form-group">
                        <div class="card">
                            <div class="card-header">
                                お客様情報
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <select class="form-control form-control-lg" id="user" name="user">
                                        <option value="">選択してください</option>
                                        @foreach($users as $key => $user)
                                            <option value="{{$user->id}}">{{$user->sei}} {{$user->mei}}</option>
                                        @endforeach
                                    </select>
                                    <div
                                        id="err_player"
                                        class="alert alert-danger"
                                        role="alert"
                                        style="display: none">
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--                    <!-- トレーナ -->--}}
                        {{--                    <div class="modal-footer">--}}
                        {{--                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>--}}
                        {{--                        <button type="button" class="btn btn-danger">予約却下</button>--}}
                        {{--                        <button type="submit" class="btn btn-success">予約確定する</button>--}}
                        {{--                    </div>--}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                        <button
                            type="button"
                            class="btn btn-danger"
                            id="reservation_delete_button">削除
                        </button>
                        <input type="hidden" id="reservation_id_delete" value="">
                        {{--                <button type="button" id="btnTestSaveLarge" class="btn btn-default">--}}
                        {{--                    <span class="d-none d-md-inline">Save changes</span>--}}
                        {{--                    <span class="d-md-none">Save</span>--}}
                        {{--                </button>--}}
                        <button type="submit" class="btn btn-success">
                        <span
                            class="spinner-border spinner-border-sm"
                            role="status"
                            aria-hidden="true">
                        </span>
                            予約確定
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>
