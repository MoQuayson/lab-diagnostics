<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabTestRequest;
use App\Models\LabTests;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;


class AdminLabTestsController extends Controller
{
    function __construct()
    {
         //$this->middleware('permission:test-list|test-create|test-edit|test-delete', ['only' => ['index','store']]);
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
        $users = User::join('appointment','appointment.user_id','=','users.id')
        ->where('appointment.schedule','=',today()->toDateString())
        ->get();
        //return $users;
        return view('admin.lab-test.index',compact('users'));
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
            $user->labTest()->create([
                'user_id'=>$user->id,
                'name'=>$request->input('name'),
                'price'=>$request->input('price'),
                'results'=>$request->input('result'),
            ]);

            $user->appointment()->update(
               [ 'status'=>'Checked In']
            )->where('appointment.created_at', now());

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
        if(LabTests::exists($id))
        {
            $lab_tests = array(
                'lab_tests'=> DB::table('users')
                ->join('lab_tests','lab_tests.user_id','=','users.id')
                ->where('lab_tests.id',$id)
                ->select('lab_tests.id','lab_tests.name','results','price','lab_tests.created_at',
                'users.name as fullname','gender','email','telephone')
                ->first()
            );
            //return $lab_tests;
            /*$data = [

                'title' => 'Welcome to ItSolutionStuff.com',

                'date' => date('m/d/Y')

            ];*/



            $pdf = PDF::loadView('file-download', $lab_tests);

            return $pdf->download('lab-test results.pdf');

            return view('file-download', $lab_tests);
        }

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
    public function update(LabTestRequest $request, $id)
    {
        try {
            if(LabTests::exists($id))
            {
                LabTests::where('id', $id)->update([
                    'name'=>$request->input('name'),
                    'price'=>$request->input('price'),
                    'results'=>$request->input('result'),
                ]);
                session()->flash('success', 'Lab Test Updated.');
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
        if(LabTests::exists($id))
        {
            LabTests::where('id', $id)->delete();
            session()->flash('success', 'Lab Test Deleted.');
            return response()->json('Success');
        }
        else{
            session()->flash('fail', 'Invalid Data');
            return response()->json('Error');
        }
    }
}
