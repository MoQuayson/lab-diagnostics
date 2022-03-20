<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAppointmentController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = ["users"=> User::all()];
        return view('admin.appointment.index',$users);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //7
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
            $user = User::where('email', $request->input('user_id'))->first();
            $user->appointment()->create([
                'user_id'=>$user->id,
                'schedule'=>$request->input('schedule'),
                'status'=> 'Not Checked In',
            ]);

            return redirect()->back()->with('success', 'Appointment Scheduled');
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
                Appointment::where('id',$id)->update([
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
