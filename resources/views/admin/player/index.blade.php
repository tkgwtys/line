@extends('layouts.admin')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('adminPlayers') }}
        <table class="table table-striped">
            <tbody>
            @foreach($players as $player)
                <tr>
                    <td>
                        <a href="{{url('/admin/player/'. $player->id)}}">
                            {{$player->sei}}{{$player->mei}}
                        </a>
                        <img src="{{ asset('storage/images/players/'. $player->id .'/original.jpg'). '?' . time() }}"
                             width="50">
                    </td>
                    <td align="right">
                        <a href="{{url('/admin/player/'.$player->id.'/edit')}}" class="btn btn-warning">編集</a>
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
