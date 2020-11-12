@extends('layouts.admin')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('adminPlayer') }}
        <table class="table table-striped">
            <tbody>
            @foreach($players as $player)
                <tr>
                    <td>
                        <a href="{{url('/admin/player/'. $player->id . '?start_date='. $today. '&day_count=7')}}">
                            {{$player->sei}}{{$player->mei}}
                        </a>
                        <img src="{{ asset('storage/images/users/'. $player->id .'/w300.jpg'). '?' . time() }}" width="50">
                    </td>
                    <td align="right">
                        <a href="{{url('/admin/user/'.$player->id.'/edit')}}" class="btn btn-warning">編集</a>
                        <form action="{{url('/admin/player/'. $player->id)}}" method="post" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="削除" class="btn btn-delete btn-danger"
                                   onclick="return confirm('削除しますか？')">
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
