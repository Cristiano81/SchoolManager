@extends('layouts.app', ['activePage' => 'classroom', 'titlePage' => __('Classrooms')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Classrooms</h4>
                        <p class="card-category"> Here you can manage classrooms</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{route('classroom.create')}}" class="btn btn-sm btn-primary">Add classroom</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                {{ Form::open(array('method'=>'GET','route' => ['classroom.index'])) }}
                                <div class="form-group">
                                    {{ Form::label('classroom', 'Search classroom') }}
                                    {{ Form::text('classroom', $searchclassroom, array('class' => 'form-control')) }}

                                </div>
                                {{ Form::submit('Search', array('class' => 'btn btn-primary')) }}
                                {{Form::close()}}

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                <tr><th>
                                        School Year
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Students
                                    </th>
                                    <th class="text-right">
                                        Actions
                                    </th>
                                </tr></thead>
                                <tbody>
                                @if(!empty($classrooms))
                                    @foreach($classrooms as $classroom)
                                        <tr>
                                            <td>{{$classroom->schoolyear->startYear . "/" . $classroom->schoolyear->endYear}}</td>
                                            <td>{{$classroom['name']}}</td>
                                            <td>{{$classroom->students()->count()}}</td>
                                            <td class="td-actions text-right">
                                                <a rel="tooltip" class="btn btn-success btn-link" href="{{route('classroom.build',$classroom['id'])}}" data-original-title="" title="">
                                                    <i class="material-icons">account_box</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <a rel="tooltip" class="btn btn-success btn-link" href="{{route('classroom.edit',$classroom['id'])}}" data-original-title="" title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <a rel="tooltip" class="btn btn-success btn-link" href="{{route('classroom.show',$classroom['id'])}}" data-original-title="" title="">
                                                    <i class="material-icons">delete</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
