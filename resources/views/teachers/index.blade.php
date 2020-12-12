@extends('layouts.app', ['activePage' => 'teacher', 'titlePage' => __('Teachers')])

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
                        <h4 class="card-title ">Teachers</h4>
                        <p class="card-category"> Here you can manage teachers</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{route('teacher.create')}}" class="btn btn-sm btn-primary">Add teacher</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                {{ Form::open(array('method'=>'GET','route' => ['teacher.index'])) }}
                                <div class="form-group">
                                    {{ Form::label('teacher', 'Search teacher') }}
                                    {{ Form::text('teacher', $searchteacher, array('class' => 'form-control')) }}

                                </div>
                                {{ Form::submit('Search', array('class' => 'btn btn-primary')) }}
                                {{Form::close()}}

                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                <tr><th>
                                        Name
                                    </th>
                                    <th>
                                        Surname
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Telephone
                                    </th>
                                    <th class="text-right">
                                        Actions
                                    </th>
                                </tr></thead>
                                <tbody>
                                @if(!empty($teachers))
                                    @foreach($teachers as $teacher)
                                        <tr>
                                            <td>{{$teacher['name']}}</td>
                                            <td>{{$teacher['surname']}}</td>
                                            <td><a href="mailto:{{$teacher['email']}}">{{$teacher['email']}}</a></td>
                                            <td>{{$teacher['telephone']}}</td>
                                            <td class="td-actions text-right">
                                                <a rel="tooltip" class="btn btn-success btn-link" href="{{route('teacher.edit',$teacher['id'])}}" data-original-title="" title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <a rel="tooltip" class="btn btn-success btn-link" href="{{route('teacher.show',$teacher['id'])}}" data-original-title="" title="">
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
