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
                        <p class="card-category"> Here you can delete a classroom</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{route('classroom.index')}}" class="btn btn-sm btn-primary">Back to the list</a>
                            </div>
                        </div>
                        <!-- if there are creation errors, they will show here -->
                        {{ Html::ul($errors->all()) }}

                        {{ Form::open(array('method'=>'DELETE','route' => ['classroom.update',$classroom->id])) }}
                        <div class="form-group">
                            {{ Form::label('schoolyear_id', 'School Year') }}
                            {{ App\Models\SchoolYear::getname($classroom->schoolyear_id)}}

                        </div>
                        <div class="form-group">
                            {{ Form::label('name', 'Name') }}
                            {{  $classroom->name }}
                        </div>


                        {{ Form::submit('DELETE', array('class' => 'btn btn-danger','onclick'=>'return confirm(\'Are you sure?\');')) }}

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
