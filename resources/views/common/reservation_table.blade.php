<div class="col-12">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm table-hover" id="target-table">
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
                            <td id="{{$day}} {{$hi}}" data-toggle="modal" data-target="#exampleModal">{{$hi}}</td>
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
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">予約</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="aaTime"></div>
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                <button type="button" class="btn btn-primary">保存する</button>
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
