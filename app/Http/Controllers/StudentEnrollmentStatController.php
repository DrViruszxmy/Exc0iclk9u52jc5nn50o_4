<?php

namespace App\Http\Controllers;

use App\StudentEnrollmentStat;
use Illuminate\Http\Request;

class StudentEnrollmentStatController extends Controller
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
        //
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
     * @param  \App\StudentEnrollmentStat  $studentEnrollmentStat
     * @return \Illuminate\Http\Response
     */
    public function show(StudentEnrollmentStat $studentEnrollmentStat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentEnrollmentStat  $studentEnrollmentStat
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentEnrollmentStat $studentEnrollmentStat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentEnrollmentStat  $studentEnrollmentStat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentEnrollmentStat $studentEnrollmentStat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentEnrollmentStat  $studentEnrollmentStat
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentEnrollmentStat $studentEnrollmentStat)
    {
        //
    }
}
