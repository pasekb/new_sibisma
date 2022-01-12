<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = User::all();
        return view('page',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $data = new User;
        $data->first_name = $req->first_name;
        $data->last_name = $req->last_name;
        $data->name = $req->first_name.' '.$req->last_name;
        $data->dealer_code = $req->dealer_code;
        $data->email = $req->email;
        $data->username = $req->username;
        $data->password = bcrypt($req->confirm_pass);
        $data->access = $req->access;
        $data->save();

        toast('User berhasil dibuat','success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('page', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('page', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, User $user)
    {
        $data = Unit::find($user->id);
        $data->first_name = $req->first_name;
        $data->last_name = $req->last_name;
        $data->name = $req->first_name.' '.$req->last_name;
        $data->dealer_code = $req->dealer_code;
        $data->email = $req->email;
        $data->username = $req->username;
        $data->password = bcrypt($req->confirm_pass);
        $data->access = $req->access;
        $data->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deleteall(Request $req){
        User::whereIn('id',$req->pilih)->delete();
        toast('Data user berhasil dihapus','success');
        return redirect()->back();
    }
}
