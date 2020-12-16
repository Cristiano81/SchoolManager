<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        $searchstudent='';
        if ($request->has('student'))
            $searchstudent=$request->get('student');
        if (strlen($searchstudent)>0)
            $students = Student::where('name', 'like', '%' . $searchstudent . '%')
                ->orWhere('surname', 'like', '%' . $searchstudent . '%')
                ->orWhere('email', 'like', '%' . $searchstudent . '%')
                ->orWhere('telephone', 'like', '%' . $searchstudent . '%')
                ->get();
        else
            $students = Student::all();

        return view('students.index')
            ->with('students', $students)->with('searchstudent',$searchstudent);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('students.create');
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
            'email' => 'required|email|unique:students,email',
            'telephone'=>'required'
        ]);
        Student::create($request->all());

        return redirect()->route('student.index')
            ->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student=Student::find($id);
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student=Student::find($id);
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:students,email,' . $id,
            'telephone'=>'required'
        ]);
        $student = Student::find($id);
        $student->update($request->all());

        return redirect()->route('student.index')
            ->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return redirect()->route('student.index')
            ->with('success', 'Student deleted successfully');
    }

    /**
     * Search specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchstudent='';
        if ($request->has('q'))
            $searchstudent=$request->get('q');
        if (strlen($searchstudent)>0)
            $students = Student::where('name', 'like', '%' . $searchstudent . '%')
                ->orWhere('surname', 'like', '%' . $searchstudent . '%')
                ->orWhere('email', 'like', '%' . $searchstudent . '%')
                ->orWhere('telephone', 'like', '%' . $searchstudent . '%')
                ->get();
        else
            $students = Student::all();
        return json_encode(array('data'=>$students));
    }
}
