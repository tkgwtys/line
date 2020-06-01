<div class="col-12">
    <div class="scroll_div">
        <table class="table table-bordered table-striped table-sm table-hover" id="target-table"
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
                <th></th>
            </tr>
            </thead>
            @foreach($days_array as $day)
                <tbody>
                <tr class="chara">
                    <th rowspan="{{count($player_array)}}">{{$day}}</th>
                    @foreach($player_array as $key => $player)
                        <th class="playerName">{{$player->sei}}{{$player->mei}}</th>
                        @foreach($time_array as $key => $time)
                            @foreach($time as $hi)
                                <td data-day="{{$day}}" data-time="{{$hi}}" data-toggle="modal"
                                    data-target="#exampleModal"></td>
                            @endforeach
                        @endforeach
                        <th class="playerName">{{$player->sei}}{{$player->mei}}</th>
                </tr>
                @endforeach
                </tbody>
            @endforeach
        </table>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-fluid modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">予約確認</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>予約日</label>
                        <input id="day" value="" class="selector form-control" type="text"/>
                    </div>
                {{--                <div id="aaTime"></div>--}}
                <!-- 時間 -->
                    <div class="form-group">
                        <label>予約時間</label>
                        <select class="form-control" id="time">
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
                        <select class="form-control" id="time">
                            @foreach($player_array as $key => $player)
                                <option>{{$player->sei}} {{$player->mei}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- トレーナ -->
                    <div class="card">
                        <div class="card-header">
                            お客様
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">お名前</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="recipient-name"
                                    placeholder="予約した人の名前が入る予定"
                                    value="佐々木のぞみ">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">性別</label>
                                女性
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                <button type="button" class="btn btn-danger">予約却下</button>
                <button type="button" class="btn btn-success">予約確定する</button>
            </div>
        </div>
    </div>
</div>


{{--<div class="table-responsive">--}}
{{--    <table class="table table-bordered table-striped">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th></th>--}}
{{--            <th>--}}

{{--                Extra small devices--}}
{{--                <small>Phones (&lt;768px)</small>--}}
{{--            </th>--}}
{{--            <th>--}}
{{--                Small devices--}}
{{--                <small>Tablets (&ge;768px)</small>--}}
{{--            </th>--}}
{{--            <th>--}}
{{--                Medium devices--}}
{{--                <small>Desktops (&ge;992px)</small>--}}
{{--            </th>--}}
{{--            <th>--}}
{{--                Large devices--}}
{{--                <small>Desktops (&ge;1200px)</small>--}}
{{--            </th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        <tr>--}}
{{--            <th class="text-nowrap" scope="row">Grid behavior</th>--}}
{{--            <td>Horizontal at all times</td>--}}
{{--            <td colspan="3">Collapsed to start, horizontal above breakpoints</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <th class="text-nowrap" scope="row">Container width</th>--}}
{{--            <td>None (auto)</td>--}}
{{--            <td>750px</td>--}}
{{--            <td>970px</td>--}}
{{--            <td>1170px</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <th class="text-nowrap" scope="row">Class prefix</th>--}}
{{--            <td><code>.col-xs-</code></td>--}}
{{--            <td><code>.col-sm-</code></td>--}}
{{--            <td><code>.col-md-</code></td>--}}
{{--            <td><code>.col-lg-</code></td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <th class="text-nowrap" scope="row"># of columns</th>--}}
{{--            <td colspan="4">12</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <th class="text-nowrap" scope="row">Column width</th>--}}
{{--            <td class="text-muted">Auto</td>--}}
{{--            <td>~62px</td>--}}
{{--            <td>~81px</td>--}}
{{--            <td>~97px</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <th class="text-nowrap" scope="row">Gutter width</th>--}}
{{--            <td colspan="4">30px (15px on each side of a column)</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <th class="text-nowrap" scope="row">Nestable</th>--}}
{{--            <td colspan="4">Yes</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <th class="text-nowrap" scope="row">Offsets</th>--}}
{{--            <td colspan="4">Yes</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <th class="text-nowrap" scope="row">Column ordering</th>--}}
{{--            <td colspan="4">Yes</td>--}}
{{--        </tr>--}}
{{--        </tbody>--}}
{{--    </table>--}}
