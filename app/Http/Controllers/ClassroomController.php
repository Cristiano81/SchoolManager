<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\View\View;
class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        $searchclassroom='';
        if ($request->has('classroom'))
            $searchclassroom=$request->get('classroom');
        if (strlen($searchclassroom)>0)
            $classrooms = Classroom::where('name', 'like', '%' . $searchclassroom . '%')->get();
        else
            $classrooms = Classroom::all();


        return view('classrooms.index')
            ->with('classrooms', $classrooms)->with('searchclassroom',$searchclassroom);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('classrooms.create');
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'schoolyear_id' => 'exists:school_years,id',
        ]);
        Classroom::create($request->all());

        return redirect()->route('classroom.index')
            ->with('success', 'Classroom created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        return view('classrooms.show', compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        return view('classrooms.edit', compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'schoolyear_id' => 'exists:school_years,id',
        ]);
        $classroom->update($request->all());

        return redirect()->route('classroom.index')
            ->with('success', 'Classroom updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        return redirect()->route('classroom.index')
            ->with('success', 'Classroom deleted successfully');
    }
    public function getTeachers($id)
    {
        $teachers=Classroom::with('teachers')->find($id)->teachers;
        return json_encode(array('data'=>$teachers));
    }
    public function getStudents($id)
    {
        $students=Classroom::with('students')->find($id)->students;
        return json_encode(array('data'=>$students));
    }
}
