<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Validation\Rule;

use App\Http\Requests;

use App\DTRPSEmployee;
use App\User;
use App\AccessList;
use App\RegisteredUser;

use Carbon\Carbon;
use DB;
use Response;
use Hash;
use validate;
use Redirect;
use Validator;

class ControlPanelController extends Controller
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
        $count = 0;
        $acess_lists = AccessList::with('subModules')->get();
        $employees = DTRPSEmployee::with('employment.department')->get();
        
        return view('c_panel.index', compact('employees', 'count', 'acess_lists'));
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
    public function store(CreateUserRequest $request)
    {
        $modules = $request->input('access_lists');

        $date = Carbon::now();
        if ($request['account_span'] != 'year') {
            $date->addMonths($request['quantity']);
        } else {
            $date->addYears($request['quantity']);
        }

        $user = User::create([
            'username' => $request['username'],
            'password' => bcrypt($request['password']),
            'employee_id' => $request['emp_id'],
            'account_span' => $date,
            'status' => 'activate',
        ]);

        $register = new RegisteredUser([
            'date_created' => Carbon::now()
        ]);
        $user->register()->save($register);
        
        foreach ($modules as $module) {
            foreach ($module['sub_modules'] as $accessibility) {
                if ($accessibility['check']) {
                    $user->accessiblities()->attach($accessibility['sml_id'], ['date_created' => Carbon::now()]);
                }
            }
        }

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
        $user = User::find($id);
        $this->validate($request, [
            'username' => [
                'required',
                Rule::unique('users')->ignore($user->user_id, 'user_id'),
            ],
            'current_password' => 'required',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required',
            'account_span' => 'required',
            'quantity' => 'required',
        ]);

        if (Hash::check($request['current_password'], $user->password)) {
            $modules = $request->input('access_lists');
            $date = Carbon::now();
            if ($request['account_span'] != 'year') {
                $date->addMonths($request['quantity']);
            } else {
                $date->addYears($request['quantity']);
            }

            $user->update([
                'username' => $request['username'],
                'password' => bcrypt($request['password']),
                'employee_id' => $request['emp_id'],
                'account_span' => $date,
                'status' => 'activate',
            ]);

            $user->accessiblities()->detach();

            foreach ($modules as $module) {
                foreach ($module['sub_modules'] as $accessibility) {
                    if ($accessibility['check']) {
                        $user->accessiblities()->attach($accessibility['sml_id'], ['date_created' => Carbon::now()]);
                    }
                }
            }

            return ['message' => 'Successfully Updated'];
        }
        return 'Incorrect Current Password';
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

    public function showLogHistory()
    {
        return view('c_panel.log_history.index');
    }

    public function getUserInfo()
    {
        $employee_id = $_GET['employee_id'];

        $user = User::where('employee_id', $employee_id)->with('accessiblities')->first();

        return Response::json($user);
    }

    public function getAccessList()
    {
        $acess_lists = AccessList::with('subModules')->get();

        return Response::json($acess_lists);
    }

    public function getRegisteredUsers()
    {
        $users = RegisteredUser::with('user.employee.employment.department')->get();

        return Response::json($users);
    }

    public function activeOrDeactive(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        $user = User::find($id)->update(['status' => $status]);
    }
}
