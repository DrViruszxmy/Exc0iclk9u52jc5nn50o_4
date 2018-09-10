<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreateRequirementRequest;
use App\Http\Requests\CreateStudentScholarshipRequest;
use App\Http\Requests;

use App\Requirement_List;
use App\Scholarship_List;
use Response;

class ControlPanelGeneralSettingController extends Controller
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
        return view('c_panel.general_settings.index');
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
    public function store(CreateRequirementRequest $request)
    {
        Requirement_List::create($request->input('requirement'));

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
    public function update(CreateRequirementRequest $request, $id)
    {
        Requirement_List::find($id)->update($request->input('requirement'));

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
        Requirement_List::find($id)->delete();

        return ['message' => 'Successfully Deleted'];
    }

    public function getRequirements()
    {
        $requirements = Requirement_List::all();

        return Response::json($requirements);
    }

    public function activeOrDeactive(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');

        Requirement_List::find($id)->update(['status' => $status]);
    }

    public function storeScholarship(CreateStudentScholarshipRequest $request)
    {
        Scholarship_List::create($request->input('scholarship'));

        return ['message' => 'Successfully Added'];
    }

    public function getScholarship()
    {
        $scholarships = Scholarship_List::all();

        return Response::json($scholarships);
    }

    public function deleteScholarship($id)
    {
        Scholarship_List::find($id)->delete();

        return ['message' => 'Successfully Deleted'];
    }

    public function updateScholarship(CreateStudentScholarshipRequest $request, $id)
    {
        Scholarship_List::find($id)->update($request->input('scholarship'));

        return ['message' => 'Successfully Updated'];
    }
    
}
