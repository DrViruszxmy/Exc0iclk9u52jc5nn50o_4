<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProgramRequest;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\ActivationHistory;
use App\Department;
use App\ProgramList;
use App\Usage_Status;

use Auth;
use Response;
use Carbon\Carbon;


class ControlPanelProgramSettingController extends Controller
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
        $departments = Department::orderBy('dep_name', 'asc')->get();
      
        return view('c_panel.program_settings.index', compact('departments'));
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
    public function store(CreateProgramRequest $request)
    {
        $program = ProgramList::create($request->all());

        $status = new Usage_Status(['status' => 'active']);
        $program->usageStatus()->save($status);

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
    public function update(CreateProgramRequest $request, $id)
    {
        $program = ProgramList::find($id);
        $program->update($request->all());

        $history = new ActivationHistory([
            'responsible' => Auth::user()->user_id,
            'date' => Carbon::now(),
            'time' => Carbon::now(),
            'registered_ip' => request()->ip(),
            'trans_type' => 'modify'
        ]);
        $program->histories()->save($history);

        return ['message' => 'Successfully Updated'];
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

    public function getProgramList()
    {
        $type = $_GET['type'];

        if ($type != 'all') {
            $programs = ProgramList::with('usageStatus', 'department')
                ->where('level', $type)
                ->orderBy('created_at', 'asc')
                ->get();

            return Response::json($programs);
        }
        $programs = ProgramList::with('usageStatus', 'department')
            ->orderBy('created_at', 'asc')
            ->get(); 

        return Response::json($programs);
    }

    public function getActivaitonHistories()
    {
        $type = $_GET['type'];

        $histories = ActivationHistory::with('program.department', 'user.employee')
                ->where('trans_type', $type)
                ->orderBy('created_at', 'asc')
                ->get();
        return Response::json($histories);
    }

    public function activeOrDeactive(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');

        $program = ProgramList::where('pl_id', $id)->with('usageStatus')->first();
        Usage_Status::find($program->usageStatus->us_id)->update(['status' => $status]);

        $history = new ActivationHistory([
            'responsible' => Auth::user()->user_id,
            'date' => Carbon::now(),
            'time' => Carbon::now(),
            'registered_ip' => request()->ip(),
            'trans_type' => $status
        ]);
        $program->histories()->save($history);

    }
}
