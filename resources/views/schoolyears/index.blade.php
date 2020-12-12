@extends('layouts.app', ['activePage' => 'schoolyear', 'titlePage' => __('School Years')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                        <span>
                    {{ session()->get('success') }}</span>
                    </div>
                @endif

                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">School Years</h4>
                        <p class="card-category"> Here you can manage school years</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{route('schoolyear.create')}}" class="btn btn-sm btn-primary">Add school year</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                {{ Form::open(array('method'=>'GET','route' => ['schoolyear.index'])) }}
                                <div class="form-group">
                                    {{ Form::label('year', 'Search year') }}
                                    {{ Form::text('year', $searchyear, array('class' => 'form-control')) }}

                                </div>
                                {{ Form::submit('Search', array('class' => 'btn btn-primary')) }}
                                {{Form::close()}}

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                <tr><th>
                                        Year
                                    </th>
                                    <th>
                                        Classrooms
                                    </th>
                                    <th class="text-right">
                                        Actions
                                    </th>
                                </tr></thead>
                                <tbody>
                                @if(!empty($schoolyears))
                                    @foreach($schoolyears as $schoolyear)
                                        <tr>
                                            <td>{{$schoolyear['startYear'] . "/" . $schoolyear['endYear']}}</td>
                                            <td>{{$schoolyear->classrooms()->count()}}</td>
                                            <td class="td-actions text-right">
                                                <a rel="tooltip" class="btn btn-success btn-link" href="{{route('schoolyear.details',$schoolyear['id'])}}" data-original-title="" title="">
                                                    <i class="material-icons">zoom_in</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <a rel="tooltip" class="btn btn-success btn-link" href="{{route('schoolyear.edit',$schoolyear['id'])}}" data-original-title="" title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <a rel="tooltip" class="btn btn-success btn-link" href="{{route('schoolyear.show',$schoolyear['id'])}}" data-original-title="" title="">
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
