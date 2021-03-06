@extends('layouts.app', ['activePage' => 'teacher', 'titlePage' => __('Teachers')])
<?php

?>
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Teachers</h4>
                        <p class="card-category"> Here you can update a teacher</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{route('teacher.index')}}" class="btn btn-sm btn-primary">Back to the list</a>
                            </div>
                        </div>
                            <!-- if there are creation errors, they will show here -->
                            {{ Html::ul($errors->all()) }}

                            {{ Form::open(array('method'=>'DELETE','route' => ['teacher.update',$teacher->id])) }}
                            <div class="form-group">
                                {{ Form::label('name', 'Name') }}
                                {{  $teacher->name }}

                            </div>
                            <div class="form-group">
                                {{ Form::label('surname', 'Surname') }}
                                {{ $teacher->surname }}

                            </div>
                            <div class="form-group">
                                {{ Form::label('email', 'E-mail') }}
                                {{  $teacher->email }}

                            </div>

                            <div class="form-group">
                                {{ Form::label('telephone', 'Telephone') }}
                                {{ $teacher->telephone }}

                            </div>


                            {{ Form::submit('DELETE', array('class' => 'btn btn-danger','onclick'=>'return confirm(\'Are you sure?\');')) }}

                            {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
