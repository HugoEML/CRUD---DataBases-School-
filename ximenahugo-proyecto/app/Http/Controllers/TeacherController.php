<?php

namespace ProyectoLaravel\Http\Controllers;

use Illuminate\Http\Request;
use ProyectoLaravel\Teacher;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::All();
        return view('teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.create');
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
            'name' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'area' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'radio' => 'required',
            'avatar' => 'required|image'
        ]); 

        $teacher = new Teacher;
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/',$name);
        }
        $teacher->name = $request->input('name');
        $teacher->lastname = $request->input('lastname');
        $teacher->address = $request->input('address');
        $teacher->matter = $request->input('area');
        $teacher->city = $request->input('city');
        $teacher->phone = $request->input('phone');

        if($request->input('radio') == 'feminine'){
            $teacher->sex = 'Feminine';
        }
        else{
            if($request->input('radio') == 'masculine'){
                $teacher->sex = 'Masculine';
            }
            else{
                $teacher->sex = 'No binary';
            }      
        }

        $teacher->avatar = $name;
        $teacher->slug = time().$request->input('name');
        $teacher->save();

        $teachers = Teacher::All();
        return view('teacher.index', compact('teachers'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        return view('teacher.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        return view('teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        $teacher->fill($request->except('avatar'));

        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $name = time().$file->getClientOriginalName();
            $teacher->avatar = $name;
            $file->move(public_path().'/images/',$name); 
        }

        $teacher->save();

        return 'Updated';
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
