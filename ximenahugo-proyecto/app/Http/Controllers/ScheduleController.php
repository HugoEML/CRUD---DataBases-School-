<?php

namespace ProyectoLaravel\Http\Controllers;

use Illuminate\Http\Request;
use ProyectoLaravel\Schedule;
use ProyectoLaravel\Area;
use ProyectoLaravel\Course;



class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses =Course::All();
        return view('schedules.index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::All();
        $courses = Course::All();

        return view('schedules.create',compact(['courses','areas']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'startime' => 'required',
            'endtime' => 'required',
            'courses' => 'required',
            'areas' => 'required'
             ]);

        $schedule = new Schedule;
        $schedule->startime = $request->input('startime');
        $schedule->endtime = $request->input('endtime');
        $schedule->course_id = $request['courses'];
        $schedule->area_id = $request['areas'];
        
        $schedule->save();

        return 'sirve';
        //$schedules = Schedule::All();
        //return view('schedules.index', compact('schedules'));

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
