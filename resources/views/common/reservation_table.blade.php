<div class="scroll_div">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm table-hover"
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
                                @foreach($reservations as $reservation)
                                    @if($day.' '.$hi.':00' == $reservation->reserved_at && $player->id == $reservation->player_id)
                                        <td data-day="{{$day}}"
                                            data-time="{{$hi}}"
                                            data-toggle="modal"
                                            data-target="#modalLarge">予約
                                        </td>
                                    @else
                                        <td data-day="{{$day}}"
                                            data-time="{{$hi}}"
                                            data-toggle="modal"
                                            data-target="#modalLarge">
                                        </td>
                                    @endif
                                @endforeach
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
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLargeLabel">予約フォーム</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="reservation_day">予約日</label>
                        <input id="reservation_day" class="selector form-control form-control-lg" type="text"/>
                    </div>
                    <input type="hidden" value="" id="selected_date" name="selected_date">
                    <!-- 時間 -->
                    <div class="form-group">
                        <label for="selected_time">予約時間</label>
                        <select class="form-control form-control-lg" id="selected_time" name="selected_time">
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
                        <label for="player">担当トレーナ</label>
                        <select class="form-control form-control-lg" id="player" name="player">
                            @foreach($player_array as $key => $player)
                                <option value="{{$player->id}}">{{$player->sei}} {{$player->mei}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- トレーナ -->
                    <div class="form-group">
                        <div class="card">
                            <div class="card-header">
                                お客様情報
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="user">お名前</label>
                                    <select class="form-control form-control-lg" id="user" name="user">
                                        @foreach($users as $key => $user)
                                            <option value="{{$user->id}}">{{$user->sei}} {{$user->mei}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                    <div class="modal-footer">--}}
                    {{--                        button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>--}}
                    {{--                        <button type="button" class="btn btn-danger">予約却下</button>--}}
                    {{--                        <button type="submit" class="btn btn-success">予約確定する</button>--}}
                    {{--                    </div>--}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                    <button type="button" class="btn btn-danger">却下</button>
                    {{--                <button type="button" id="btnTestSaveLarge" class="btn btn-default">--}}
                    {{--                    <span class="d-none d-md-inline">Save changes</span>--}}
                    {{--                    <span class="d-md-none">Save</span>--}}
                    {{--                </button>--}}
                    <button type="submit" class="btn btn-success">予約確定する</button>
                </div>
            </form>
        </div>
    </div>
</div>
