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

                            {{ Form::open(array('method'=>'DELETE','route' => ['student.update',$student->id])) }}
                            <div class="form-group">
                                {{ Form::label('name', 'Name') }}
                                {{  $student->name }}

                            </div>
                            <div class="form-group">
                                {{ Form::label('surname', 'Surname') }}
                                {{ $student->surname }}

                            </div>
                            <div class="form-group">
                                {{ Form::label('email', 'E-mail') }}
                                {{  $student->email }}

                            </div>

                            <div class="form-group">
                                {{ Form::label('telephone', 'Telephone') }}
                                {{ $student->telephone }}

                            </div>


                            {{ Form::submit('DELETE', array('class' => 'btn btn-danger','onclick'=>'return confirm(\'Are you sure?\');')) }}

                            {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection