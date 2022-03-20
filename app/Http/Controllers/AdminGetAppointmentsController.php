<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminGetAppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$appointments = DB::table('users')
        ->join('appointment','appointment.user_id','=','users.id')
        ->select('appointment.id','name','schedule','status')
        ->orderBy('appointment.created_at','desc')
        ->get();*/

        $appointments = DB::table('users')
        ->join('appointment','appointment.user_id','=','users.id')
        ->where('appointment.status','Not Checked In')
        ->select('appointment.id','name','schedule','status')
        ->orderBy('appointment.created_at','desc')
        ->paginate(5);

        //return $appointments;
        return response()->json($appointments);
    }
}
