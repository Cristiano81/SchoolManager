@extends('layouts.app', ['activePage' => 'schoolyear', 'titlePage' => __('School Years')])
<?php

?>
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">School Years</h4>
                        <p class="card-category"> Here you can add a school year</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{route('schoolyear.index')}}" class="btn btn-sm btn-primary">Back to the list</a>
                            </div>
                        </div>
                            <!-- if there are creation errors, they will show here -->
                            {{ Html::ul($errors->all()) }}

                            {{ Form::open(array('url' => 'schoolyear')) }}
                            <div class="form-group">
                                {{ Form::label('startYear', 'Start Year') }}
                                {{ Form::text('startYear', Input::old('start year'), array('class' => 'form-control')) }}

                            </div>
                        <div class="form-group">
                            {{ Form::label('endYear', 'End Year') }}
                            {{ Form::text('endYear', Input::old('end year'), array('class' => 'form-control')) }}

                        </div>


                            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

                            {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
