<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserValidation;
use App\Http\Requests\UserUpdateValidation;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id','ASC')->get();
        $admin = User::where('role_id',1)->count();
        $emple = User::where('role_id',2)->count();
        return view('user.index',compact('users','admin','emple'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::orderBy('id','ASC')->get();
        return view('user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserValidation $request)
    {
        $user = new User();
        $tanda = implode(',',$request->tanda);

        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->cedula = $request->cedula;
        $user->tanda = $tanda;
        $user->comision = $request->comision;
        $user->password = Hash::make($request->password);
        $user->fecha_ingreso = $request->fecha_ingreso;
        $user->role_id = $request->role;
        $user->slug = str_slug($request->full_name.time(),'-');
        $user->save();

        return redirect()->route('admin-home')->with('status',$user->email);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $user = User::where('slug',$slug)->firstOrFail();
        return view('user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $user = User::where('slug',$slug)->firstOrFail();
        $roles = Role::orderBy('id','ASC')->get();
        $tandas = explode(',',$user->tanda);
        return view('user.edit',compact('user','roles','tandas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateValidation $request, $slug)
    {
        $user = User::where('slug',$slug)->firstOrFail();
        $tanda = implode(',',$request->tanda);
        $estado = true;

        if($request->estado != "1"){
            $estado = false;
        }

        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->cedula = $request->cedula;
        $user->tanda = $tanda;
        $user->comision = $request->comision;
        //$user->password = Hash::make($request->password);
        $user->fecha_ingreso = $request->fecha_ingreso;
        $user->role_id = $request->role;
        $user->estado = $estado;
        if($user->full_name != $request->full_name){
            $user->slug = str_slug($request->full_name.time(),'-');
        }
        $user->save();

        return redirect()->route('show-user',$user->slug)->with('status','Usuario actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $user = User::where('slug',$slug)->firstOrFail();
        $user->delete();

        return redirect()->route('admin-home')->with('delete','El usuario ha sido eliminado exitosamente!');
    }
}
