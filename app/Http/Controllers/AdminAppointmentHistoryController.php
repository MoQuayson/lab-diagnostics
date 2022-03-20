<?php

namespace App\Http\Controllers;

use App\Models\LabTests;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAppointmentHistoryController extends Controller
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
        $users= User::all();
        /*$appointment_history = $users->load([
            'appointment',
            'labTest'
        ]);*/
        $lab_tests = DB::table('lab_tests');
        $appointment_history = ['appointment_history'=>DB::table('users')
        ->join('appointment','appointment.user_id','=','users.id')
        //->union($lab_tests)
        ->leftJoin('lab_tests','lab_tests.user_id','=','appointment.user_id')
        ->select('users.name as fullname','gender','users.email','users.telephone',
                'appointment.id as appointment_id','schedule',
                'lab_tests.name as test_name','price','lab_tests.id as test_id','results')
        ->paginate(1)];
        
        return $appointment_history;
        //return view('admin.appointment-history.index',$appointment_history);
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
