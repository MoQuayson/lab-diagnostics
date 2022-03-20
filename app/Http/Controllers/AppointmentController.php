<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$appointment = Auth::user()->load(['appointment']);
        return view('users.appointment.index',compact($appointment));*/
        $users = ["users"=> User::all()];
        return view('users.appointment.index',$users);
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
    public function store(AppointmentRequest $request)
    {
        try {
            $role_id =  Auth::user()->roles[0]->pivot->role_id; //get user role
            $role_name = Role::findById($role_id)->name;//get role name

            if($role_name == 'super-user')
            {
                $user = User::where('email',$request->input('user_id'))->first();
                $user->appointment()->create([
                    'user_id'=>$user->id,
                    'schedule'=>$request->input('schedule'),
                    'status'=> 'Not Attended',
                ]);

                return redirect()->back()->with('success', 'Appointment scheduled');
            }
            
            else if($role_name == 'user')
            {
                $user = Auth::user();
                $user->appointment()->create([
                    'user_id'=>$user->id,
                    'schedule'=>$request->input('schedule'),
                    'status'=> 'Not Attended',
                ]);

                return redirect()->back()->with('success', 'Appointment scheduled');
            }
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
    public function update(AppointmentRequest $request, $id)
    {
        try {
            if(Appointment::exists($id))
            {
                $user = Auth::user();
                $user->appointment()->update([
                    'schedule'=>$request->input('schedule'),
                ]);
                session()->flash('success', 'Appointment Updated.');
                return response()->json('Success');
            }
            else{
                session()->flash('fail', 'Invalid Data');
                return response()->json('Error');
            }
        } catch (Exception $ex) {
            session()->flash('fail', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //if appointment id exists
        if(Appointment::exists($id))
        {
            Appointment::where('id', $id)->delete();
            session()->flash('success', 'Appointment Deleted.');
            return response()->json('Success');
        }
        else{
            session()->flash('fail', 'Invalid Data');
            return response()->json('Error');
        }

    }
}
