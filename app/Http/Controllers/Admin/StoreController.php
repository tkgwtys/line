<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateStoreRequest;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::all();
        return view('admin/store/index')
            ->with('stores', $stores);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/store/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStoreRequest $request)
    {
        $store = Store::create($request->all());
        $store->save();
        return redirect('admin/store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $store = Store::find($id);
        return view('admin/store/show')
            ->with('store', $store);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Store::find($id);
        return view('admin/store/edit')
            ->with('store', $store);
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
        $store = Store::find($id);

        $store->name = $request->name;
        $store->address = $request->address;
        $store->tel = $request->tel;
        $store->url = $request->url;
        $store->business_hours = $request->business_hours;
        $store->color_code = $request->color_code;

        $store->save();
        session()->flash('flash_message', '登録が完了しました');
        return view('admin.store.edit',['store' => $store]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store_id = Store::find($id);
        $store_id->delete();
        return redirect('admin/store');
    }
}