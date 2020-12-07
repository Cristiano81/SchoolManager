@extends('layouts.app', ['activePage' => 'classroom', 'titlePage' => __('Classrooms')])
<?php

?>
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Classrooms</h4>
                        <p class="card-category"> Here you can add a classroom</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{route('classroom.index')}}" class="btn btn-sm btn-primary">Back to the list</a>
                            </div>
                        </div>
                            <!-- if there are creation errors, they will show here -->
                            {{ Html::ul($errors->all()) }}

                            {{ Form::open(array('url' => 'classroom')) }}
                            <div class="form-group">
                                {{ Form::label('schoolyear_id', 'School Year') }}
                                {{ Form::select('schoolyear_id', array_merge(\App\Models\SchoolYear::alldropdown()),'', array('class'=>'form-control'))}}

                            </div>
                            <div class="form-group">
                                {{ Form::label('name', 'Name') }}
                                {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
                            </div>


                            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

                            {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
