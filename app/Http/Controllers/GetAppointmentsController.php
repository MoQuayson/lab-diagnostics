<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetAppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role_id =  Auth::user()->roles[0]->pivot->role_id; //get user role
        $role_name = Role::findById($role_id)->name;//get role name
        //return $role_name;

        //role isnt an admin or super user
        if($role_name != 'super-user')
        {
            $appointments = DB::table('users')
            ->join('appointment','appointment.user_id','=','users.id')
            ->where('users.id',Auth::user()->id)
            ->where('appointment.status','Not Attended')
            ->select('appointment.id','name','schedule','status')
            ->orderBy('appointment.created_at','desc')
            ->paginate(5);

            return response()->json($appointments);

        }
        else{
            $appointments = DB::table('users')
            ->join('appointment','appointment.user_id','=','users.id')
            ->where('appointment.status','Not Attended')
            ->select('appointment.id','name','schedule','status')
            ->orderBy('appointment.created_at','desc')
            ->paginate(5);

            //return $appointments;
            return response()->json($appointments);
        }
        /*$appointments = DB::table('users')
        ->join('appointment','appointment.user_id','=','users.id')
        ->where('users.id',Auth::user()->id)
        ->select('appointment.id','name','schedule','status')
        ->orderBy('appointment.created_at','desc')
        ->paginate(5);

        return response()->json($appointments);*/
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
