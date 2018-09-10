<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShortCourseInfoRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Short_Course_List;
use App\StudentPersonalInfo;
use Response;
use Carbon\Carbon;

class ShortCourseController extends Controller
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
        $short_courses = Short_Course_List::all();
        // return Response::json($histories);
        return view('short_course.index', compact('short_courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateShortCourseInfoRequest $request)
    {
        $start = $request->input('time_start');
        $end = $request->input('time_end');
        $range = $request->input('date_start_end');
        $date1  = explode('T07', $range[0]);
        $date2  = explode('T07', $range[1]);

        $request['time_start'] = $start['hh'] . ':' . $start['mm'];
        $request['time_end'] = $end['hh'] . ':' . $end['mm'];
        $request['date_start'] = $date1[0];
        $request['date_end'] = $date2[0];
        $request['sc_code'] = StudentPersonalInfo::generateShortCourseCode();
        
        Short_Course_List::create($request->all());

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
}
