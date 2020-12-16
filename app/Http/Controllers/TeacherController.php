<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        $searchteacher='';
        if ($request->has('teacher'))
            $searchteacher=$request->get('teacher');
        if (strlen($searchteacher)>0)
            $teachers = Teacher::where('name', 'like', '%' . $searchteacher . '%')
                ->orWhere('surname', 'like', '%' . $searchteacher . '%')
                ->orWhere('email', 'like', '%' . $searchteacher . '%')
                ->orWhere('telephone', 'like', '%' . $searchteacher . '%')
                ->get();
        else
            $teachers = Teacher::all();

        return view('teachers.index')
            ->with('teachers', $teachers)->with('searchteacher',$searchteacher);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:teachers,email',
            'telephone'=>'required'
        ]);
        Teacher::create($request->all());

        return redirect()->route('teacher.index')
            ->with('success', 'Teacher created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacher=Teacher::find($id);
        return view('teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher=Teacher::find($id);
        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:teachers,email,' . $id,
            'telephone'=>'required'
        ]);
        $teacher = Teacher::find($id);
        $teacher->update($request->all());

        return redirect()->route('teacher.index')
            ->with('success', 'Teacher updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = Teacher::find($id);
        $teacher->delete();
        return redirect()->route('teacher.index')
            ->with('success', 'Teacher deleted successfully');
    }

    /**
     * Search specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchteacher='';
        if ($request->has('q'))
            $searchteacher=$request->get('q');
        if (strlen($searchteacher)>0)
            $teachers = Teacher::where('name', 'like', '%' . $searchteacher . '%')
                ->orWhere('surname', 'like', '%' . $searchteacher . '%')
                ->orWhere('email', 'like', '%' . $searchteacher . '%')
                ->orWhere('telephone', 'like', '%' . $searchteacher . '%')
                ->get();
        else
            $teachers = Teacher::all();
        return json_encode(array('data'=>$teachers));
    }

}
