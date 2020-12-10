<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\SchoolYear;
use Illuminate\Http\Request;

class SchoolYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schoolyears = SchoolYear::all();

        return view('schoolyears.index')
            ->with('schoolyears', $schoolyears);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('schoolyears.create');
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
            'startYear' => 'required|integer|regex:/^\d{4}$/|unique:school_years,startYear',
            'endYear' => 'required|integer|gt:startYear|regex:/^\d{4}$/|unique:school_years,endYear',
        ]);
        SchoolYear::create($request->all());

        return redirect()->route('schoolyear.index')
            ->with('success', 'SchoolYear created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schoolYear=SchoolYear::find($id);
        return view('schoolyears.show', compact('schoolYear'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schoolYear=SchoolYear::find($id);
        return view('schoolyears.edit', compact('schoolYear'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'startYear' => 'required|integer|regex:/^\d{4}$/|unique:school_years,startYear,'.$id,
            'endYear' => 'required|integer|gt:startYear|regex:/^\d{4}$/|unique:school_years,endYear,'.$id,
        ]);
        $schoolYear = SchoolYear::find($id);
        $schoolYear->update($request->all());

        return redirect()->route('schoolyear.index')
            ->with('success', 'School Year updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schoolYear = SchoolYear::find($id);
        $schoolYear->delete();
        return redirect()->route('schoolyear.index')
            ->with('success', 'School Year deleted successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $schoolYear=SchoolYear::find($id);
        return view('schoolyears.detail', compact('schoolYear'));
    }
    public function getClassrooms($id)
    {
        $classrooms=SchoolYear::with('classrooms')->find($id)->classrooms;
        return json_encode(array('data'=>$classrooms));
    }

}
