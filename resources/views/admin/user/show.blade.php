@extends('layouts.admin')
@inject('userModel', 'App\Models\User')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('adminUser', $user) }}
        <!-- ノートボタン-->
            @if($user->level === 10)
                <a href="{{url('admin/note/'.$user->id.'/post')}}" class="btn btn-primary">新規ノート</a>
            @else
        @endif
        <!-- フラッシュメッセージ -->
        <table class="table table-bordered">
            <tbody>
            <tr>
                <th style="width: 35%;">表示名</th>
                <td>{{$user->display_name}}</td>
            </tr>
            <tr>
                <th>名前</th>
                <td>{{$user->sei}}{{$user->mei}}</td>
            </tr>
            <tr>
                <th>ランク</th>
                <td>{{$userModel->getLevel($user->level)}}</td>
            </tr>
            <tr>
                <th>自己紹介</th>
                <td>{{$user->self_introduction}}</td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>{{$user->tel}}</td>
            </tr>
            <tr>
                <th>メールドレス</th>
                <td>{{$user->email}}</td>
            </tr>
            <tr>
                <th>登録日</th>
                <td>{{$user->created_at}}</td>
            </tr>
            <tr>
                <th>ブロック日</th>
                <td>{{$user->blocked_at}}</td>
            </tr>
            </tbody>
        </table>
          <h3>ノート一覧</h3>
             <table class="table table-striped">
               <thead>
                  <tr>
                    <th scope="col">ノート</th>
                    <th scope="col">作成者</th>
                    <th scope="col">登録日</th>
                  </tr>
               </thead>
               <tbody>
                 @foreach($notes as $note)
{{--                     @if(is_null($note->deleted_at))--}}
                   <tr>
                     <td>
                       {{$note->note_contents}}
                     </td>
                     <td>
                       {{$note->name}}
                     </td>
                     <td>{{$note->created_at}}</td>
                        <td align="right">
                          <form action="{{url('/admin/note/'.$note->id)}}" method="post" style="display:inline">
                           　@csrf
                           　@method('DELETE')
                           　<input type="submit" value="削除" class="btn btn-delete btn-danger" onclick="return confirm('削除しますか？')">
                          </form>
                            <a href="{{url('/admin/note/'.$note->id.'/edit')}}" class="btn btn-warning">編集</a>
                        </td>
                   </tr>
{{--                    @endif--}}
                    @endforeach
               </tbody>
             </table>
            {{$notes->links()}}
            </div>
    <div class="container">
        <a class="btn btn-primary btn-lg btn-block" href="{{url('/admin/user/'.$user->id.'/edit')}}" role="button">ユーザー編集</a>
    </div>
@endsection
