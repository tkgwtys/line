<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateNoteRequest;
use App\Models\Note;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    public function post($id)
    {
        //新規ノート作成画面へ移動（User IDでユーザーごとに違う投稿ページ）
        $user = User::where('id', $id)->first();
        $admin = Auth::user();
        return view('admin.note.create', compact('user','admin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateNoteRequest $request)
    {
        //Noteの保存
        $note = Note::create($request->all());
        $note->save();

        //Showに戻るためのデータ取得
        $user_id = $request->user_id;
        return redirect()->route('admin.user.show',['id'=>$user_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $notes = Note::where('user_id',$id)->get();
//        $user = User::where('id',$id)->first();
//        return view('admin.note.show', compact('notes','user'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note = Note::find($id);
        $user = (new \App\Models\User)->getNotes($id);
        return view('admin.note.edit', compact('note','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $note = Note::find($id);
        $note->note_contents = $request->note_contents;
        $note->save();

        $user_id = $note->user_id;
        session()->flash('flash_message', '編集が完了しました');
        return redirect()->route('admin.user.show',['id'=>$user_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::find($id);
        $note->delete();

        $user_id = $note->user_id;

        return redirect()->route('admin.user.show',['id'=>$user_id]);

    }

}
