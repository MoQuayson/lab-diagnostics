<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabTestRequest;
use App\Models\Appointment;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class LabTestsController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:test-list|test-create|test-edit|test-delete', ['only' => ['index','store']]);
         $this->middleware('permission:test-create', ['only' => ['create','store']]);
         $this->middleware('permission:test-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:test-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = ["users"=> User::all()];

        $users = User::join('appointment','appointment.user_id','=','users.id')
        ->where('appointment.schedule','=',today()->toDateString())
        ->get();
        //return $users;
        return view('users.lab-test.index',compact('users'));
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
    public function store(LabTestRequest $request)
    {
        try {
            $user = User::where('email', $request->input('user_id'))->first();
            $appointment = Appointment::where('user_id', $user->id)->where('schedule', now()->toDateString())->first();
            
            $user->labTest()->create([
                'user_id'=>$user->id,
                'name'=>$request->input('name'),
                'price'=>$request->input('price'),
                'results'=>$request->input('result'),
            ]);

            $user->appointment()->update(
               [ 'status'=>'Attended']
            )->where('appointment.schedule', today()->toDateString());

            return redirect()->back()->with('success', 'Test Added');
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
