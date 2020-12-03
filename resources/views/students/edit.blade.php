@extends('layouts.app', ['activePage' => 'student', 'titlePage' => __('Students')])
<?php

?>
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Students</h4>
                        <p class="card-category"> Here you can update a student</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{route('student.index')}}" class="btn btn-sm btn-primary">Back to the list</a>
                            </div>
                        </div>
                            <!-- if there are creation errors, they will show here -->
                            {{ Html::ul($errors->all()) }}

                            {{ Form::open(array('method'=>'PUT','route' => ['student.update',$student->id])) }}
                            <div class="form-group">
                                {{ Form::label('name', 'Name') }}
                                {{ Form::text('name', $student->name, array('class' => 'form-control')) }}

                            </div>
                            <div class="form-group">
                                {{ Form::label('surname', 'Surname') }}
                                {{ Form::text('surname', $student->surname, array('class' => 'form-control')) }}

                            </div>
                            <div class="form-group">
                                {{ Form::label('email', 'E-mail') }}
                                {{ Form::email('email', $student->email, array('class' => 'form-control')) }}

                            </div>

                            <div class="form-group">
                                {{ Form::label('telephone', 'Telephone') }}
                                {{ Form::text('telephone', $student->telephone, array('class' => 'form-control')) }}

                            </div>


                            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

                            {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
