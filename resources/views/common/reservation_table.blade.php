@inject('reservationModel', 'App\Models\Reservation')
<div class="scroll_div">
    <div class="d-flex justify-content-between">
        <div>
            <a type="button" class="btn btn-primary btn-sm" href="{{$back_link}}">先週</a>
            <a type="button" class="btn btn-primary btn-sm" href="{{$today_link}}">本日</a>
            <a type="button" class="btn btn-primary btn-sm" href="{{$next_link}}">来週</a>
            未確定数：{{$unsettled}}件
        </div>
        <button
            data-toggle="modal"
            data-day=""
            data-player_id=""
            data-time=""
            data-target="#modalLarge"
            data-course_id=""
            data-status=""
            data-user_id=""
            data-reservation_id=""
            data-sei=""
            data-mei=""
            data-store_id=""
            type="button"
            class="btn btn-primary btn-sm reservationButton">
            <svg
                width="1.5em"
                height="1.5em"
                viewBox="0 0 16 16"
                class="bi bi-pencil"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"/>
                <path fill-rule="evenodd"
                      d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"/>
            </svg>
        </button>
    </div>
    <div class="calendar">
        <table class="calendar__table" id="target-table">
            <thead>
            <tr>
                <th colspan="2" class="calendar__fixed-date">{{$start_month}}</th>
                @foreach($time_array as $key => $time)
                    @foreach($time as $hi)
                        <th>{{$hi}}</th>
                    @endforeach
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($days_array as $dayKey => $day)
                <tr class="">
                    <th rowspan="{{count($player_array)}}"
                        class="viewDay calendar__fixed-date day_number_{{$days_number_array[$dayKey]}}">{{$days_array_format[$dayKey]}}</th>
                    @foreach($player_array as $key => $player)
                        <th class="playerName calendar__fixed-name calendar__last-player-name">
                            <a href="/admin/player/{{$player->id}}">{{$player->sei}}</a>
                        </th>
                        <td colspan="68">
                            @foreach($time_array as $key => $time)
                                @foreach($time as $hi)
                                    @foreach($reservations as $reservation)
                                        @if($day.' '.$hi.':00' == $reservation->reservations_reserved_at && $player->id == $reservation->reservations_player_id)
                                            <div
                                                data-toggle="modal"
                                                data-day="{{$day}}"
                                                data-player_id="{{$player->id}}"
                                                data-time="{{$hi}}:00"
                                                data-target="#modalLarge"
                                                data-course_id="{{$reservation->reservations_course_id}}"
                                                data-status="{{$reservation->reservations_status}}"
                                                data-user_id="{{$reservation->reservations_user_id}}"
                                                data-reservation_id="{{$reservation->reservation_id}}"
                                                data-sei="{{$reservation->user_sei}}"
                                                data-mei="{{$reservation->user_mei}}"
                                                data-store_id="{{$reservation->reservations_store_id}}"
                                                data-reservation_memo="{{$reservation->reservations_memo}}"
                                                class="reservationButton plan plan--undecided plan__left-{{ltrim(str_replace(':', '', $hi), '0')}} plan__width--60">
                                                <div class="@if($reservation->reservations_status == 30) plan @endif">
                                                    <span>{{$reservation->user_sei}}{{$reservation->user_mei}} {{$reservation->courses_name}}【{{$reservation->stores_name}}】</span>
                                                </div>
                                            </div>
                                            {{--                                                    <button--}}
                                            {{--                                                        type="button"--}}
                                            {{--                                                        class="btn btn-info reservationButton"--}}
                                            {{--                                                        data-toggle="modal"--}}
                                            {{--                                                        data-day="{{$day}}"--}}
                                            {{--                                                        data-player_id="{{$player->id}}"--}}
                                            {{--                                                        data-time="{{$hi}}:00"--}}
                                            {{--                                                        data-target="#modalLarge"--}}
                                            {{--                                                        data-course_id="{{$reservation->course_id}}"--}}
                                            {{--                                                        data-status="{{$reservation->status}}"--}}
                                            {{--                                                        data-user_id="{{$reservation->user_id}}"--}}
                                            {{--                                                        data-reservation_id="{{$reservation->reservation_id}}"--}}
                                            {{--                                                        data-sei="{{$reservation->sei}}"--}}
                                            {{--                                                        data-mei="{{$reservation->mei}}"--}}
                                            {{--                                                        data-store_id="{{$reservation->store_id}}">--}}
                                            {{--                                                        {{$reservation->sei}}{{$reservation->mei}}--}}
                                            {{--                                                        {{$reservation->name}}（{{$reservation->course_time}}分）】--}}
                                            {{--                                                    </button>--}}
                                        @endif
                                    @endforeach
                                @endforeach
                                {{--                            @foreach($time as $hi)--}}
                                {{--                                @php--}}
                                {{--                                    $count = 0;--}}
                                {{--                                @endphp--}}
                                {{--                                <td colspan="{{$count}}">--}}
                                {{--                                    @foreach($reservations as $reservation)--}}
                                {{--                                        @if($day.' '.$hi.':00' == $reservation->reserved_at && $player->id == $reservation->player_id)--}}
                                {{--                                            <button--}}
                                {{--                                                type="button"--}}
                                {{--                                                class="btn btn-info reservationButton"--}}
                                {{--                                                data-toggle="modal"--}}
                                {{--                                                data-day="{{$day}}"--}}
                                {{--                                                data-player_id="{{$player->id}}"--}}
                                {{--                                                data-time="{{$hi}}:00"--}}
                                {{--                                                data-target="#modalLarge"--}}
                                {{--                                                data-course_id="{{$reservation->course_id}}"--}}
                                {{--                                                data-status="{{$reservation->status}}"--}}
                                {{--                                                data-user_id="{{$reservation->user_id}}"--}}
                                {{--                                                data-reservation_id="{{$reservation->reservation_id}}"--}}
                                {{--                                                data-sei="{{$reservation->sei}}"--}}
                                {{--                                                data-mei="{{$reservation->mei}}"--}}
                                {{--                                                data-store_id="{{$reservation->store_id}}">--}}
                                {{--                                                {{$reservation->sei}}{{$reservation->mei}}--}}
                                {{--                                                【{{$reservation->name}}（{{$reservation->course_time}}分）】--}}
                                {{--                                            </button>--}}
                                {{--                                        @endif--}}
                                {{--                                    @endforeach--}}
                                {{--                                    <button type="button"--}}
                                {{--                                            class="btn btn-link reservationButton"--}}
                                {{--                                            data-toggle="modal"--}}
                                {{--                                            data-day="{{$day}}"--}}
                                {{--                                            data-player_id="{{$player->id}}"--}}
                                {{--                                            data-time="{{$hi}}:00"--}}
                                {{--                                            data-target="#modalLarge">--}}
                                {{--                                        <svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16"--}}
                                {{--                                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">--}}
                                {{--                                            <path fill-rule="evenodd"--}}
                                {{--                                                  d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"/>--}}
                                {{--                                            <path fill-rule="evenodd"--}}
                                {{--                                                  d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"/>--}}
                                {{--                                        </svg>--}}
                                {{--                                    </button>--}}
                                {{--                                </td>--}}
                                {{--                            @endforeach--}}
                            @endforeach
                        </td>
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
                <input type="hidden" name="reservation_id" id="reservation_id" value="">
                @csrf
                <input type="hidden" name="status" value="30">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLargeLabel">
                        <span id="reservation_label"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="alert_message"></div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="reservation_day">予約日</label>
                                <input id="reservation_day" class="selector form-control form-control-lg" type="text"/>
                                <div
                                    id="err_selected_date"
                                    class="alert alert-danger"
                                    role="alert"
                                    style="display: none">
                                </div>
                                <input type="hidden" value="" id="selected_date" name="selected_date">
                            </div>
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
                                style="display: none">
                            </div>
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
                            <div class="card-header">予約お客様</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <select class="form-control form-control-lg" id="user" name="user">
                                        <option value="">選択してください</option>
                                        @foreach($users as $key => $user)
                                            <option
                                                value="{{$user->id}}">{{$user->display_name}} @if($user->sei)
                                                    （{{$user->sei}} {{$user->mei}}）@endif</option>
                                        @endforeach
                                    </select>
                                    <div
                                        id="err_user"
                                        class="alert alert-danger"
                                        role="alert"
                                        style="display: none">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="card">
                                <div class="card-header">備考欄</div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <textarea rows="4" cols="55" id="reservation_memo" name="reservation_memo">
                                        </textarea>
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
