@extends('layouts.app')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('userReservationCreate') }}
        <a class="btn btn-link" href="/reservation/{{$player_id}}">今週</a>
        <div class="table-responsive">
            <table class="table table-bordered reservation" id="reservation_user_table">
                <thead>
                <tr>
                    <th scope="col">
                        <a class="btn btn-link" href="/reservation/{{$player_id}}?start_date={{$back_date}}">次の週</a>
                    </th>
                    @foreach($days_array_format as $day)
                        <th scope="col">{{$day[1]}}<br>{{$day[0]}}</th>
                    @endforeach
                    <th scope="col">
                        <a class="btn btn-link" href="/reservation/{{$player_id}}?start_date={{$next_date}}">次の週</a>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($time_array as $key => $time)
                    @foreach($time as $hi)
                        <tr>
                            <td>{{$hi}}</td>
                            @for($i = 0; $i < $max_day ; $i++)
                                @php $var = '◯'; $class = 'reservationDateTap'; @endphp
                                <td style="padding: 0;text-align: center;vertical-align: middle">
                                    @foreach($reservations as $reservation)
                                        @if($reservation->reservations_reserved_at == $days_array[$i] . ' ' . $hi . ':00')
                                            @php $var = '✖';$class= ''; @endphp
                                            @break
                                        @endif
                                    @endforeach
                                    <span data-date="{{$days_array[$i]}} {{$hi}}"
                                          style="width: 100%;
                                      height: 100%"
                                          class="{{$class}}">
                                    {{$var}}
                                </span>
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
                            <div id="alert_message"></div>
                            <div class="form-group">
                                <label for="store">トレーナー</label><br>
                                <img
                                    src="{{ asset('storage/images/users/'. $player->id .'/original.jpg'). '?' . time() }}"
                                    width="50">
                                <p>{{$player->sei}} {{$player->mei}}</p>
                            </div>
                            <div class="form-group">
                                <label for="store">予約申請日</label>
                                <h2 id="reservationDateView"></h2>
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
                                <button
                                    type="submit"
                                    class="btn btn-success"
                                    id="reservationButton"
                                    name="reservationButton">
                                    <span class="spinner-border spinner-border-sm" role="status"
                                          aria-hidden="true"></span>
                                    予約申請
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
