<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\DTRPSDepartment;
use App\RegQueueingDepartment;
use App\RegisteredUser;

use Carbon\Carbon;
use Response;

class ControlPanelQueueSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('access')->only('index');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = DTRPSDepartment::all();
        $reg_departments = RegQueueingDepartment::with('department')->get();
        $new_departments = [];

        foreach ($departments as $department) {
            $exist = false;
            foreach ($reg_departments as $reg_department) {
                if ($department->department_id == $reg_department->department_id) {
                    $exist = true;
                }
            }

            if ($exist == false) {
                $new_departments[] = $department;
            }
        }
        return view('c_panel.queue_setting.index', compact('new_departments'));
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
        $this->validate($request, [
            'department' => 'required',
        ]);
        $id = $request->input('department');
        $users = RegisteredUser::with('user.employee.employment.department')
                ->with(['user.employee.employment.department' => function ($query) use ($id){
                    $query->where('department_id', $id);
                }])
                ->get();
        $total = 0;
        foreach ($users as $user) {
            foreach ($user->user->employee->employment as $reg_user) {
                if ($reg_user->department) {
                    $total++;
                }
            }
        }

        RegQueueingDepartment::create([
            'department_id' => $id,
            'status' => 'deactivate',
            'reg_user' => $total,
            'date_reg' => Carbon::now(),
        ]);

        return ['message' => 'Successfully Added'];
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

    public function getRegisteredDepartments()
    {
        $departments = RegQueueingDepartment::with('department')->get();

        return Response::json($departments);
    }

    public function activateOrDeactivate(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');

        RegQueueingDepartment::find($id)->update(['status' => $status]);
    }
}
