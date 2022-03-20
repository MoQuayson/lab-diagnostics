<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::join('model_has_roles','model_id','=','users.id')
        ->join('roles','roles.id','=','role_id')
        ->select('users.*','roles.name as privilege')
        ->orderby('roles.name','asc')
        ->paginate(5);
        
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->input('name'),
                'email' =>$request->input('email'),
                'telephone' => $request->input('telephone'),
                'gender' => $request->input('gender'),
                'password' => $request->input('password'),
                'password_confirmation' => $request->input('password_confirmation'),
            ]);

            $user->assignRole($request->input('privilege'));

            return redirect()->route('users.index')->with('info','User created');
        } catch (Exception $ex) {
            return redirect()->back()->with('fail', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$user = User::find($id);
        $user = User::join('model_has_roles','model_id','=','users.id')
        ->join('roles','roles.id','=','role_id')
        ->where('users.id',$id)
        ->select('users.*','roles.name as privilege')
        ->first();

        $roles = Role::all();

        $data=[
            'user'=>$user,
            'roles'=>$roles
        ];

        return view('admin.users.edit', $data);
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
        $user = User::find($id);
        $user->update([
            'name' => $request->input('name'),
            'email' =>$request->input('email'),
            'telephone' => $request->input('telephone'),
            'gender' => $request->input('gender'),
        ]);

        $role = DB::table('model_has_roles')->where('model_id', $id)->delete();

        $role=Role::findByName($request->input('role'));
        $user->assignRole([$role->name]);
        return redirect()->route('users.index')->with('success','User updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success','User deleted.');
    }
}
