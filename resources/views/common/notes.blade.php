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
    @endforeach
    </tbody>
</table>
{{$notes->appends(request()->input())->links()}}
</div>
