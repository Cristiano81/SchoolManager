@extends('layouts.app', ['activePage' => 'student', 'titlePage' => __('Students')])

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
                        <h4 class="card-title ">Students</h4>
                        <p class="card-category"> Here you can manage students</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{route('student.create')}}" class="btn btn-sm btn-primary">Add student</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                {{ Form::open(array('method'=>'GET','route' => ['student.index'])) }}
                                <div class="form-group">
                                    {{ Form::label('student', 'Search student') }}
                                    {{ Form::text('student', $searchstudent, array('class' => 'form-control')) }}

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
                                @if(!empty($students))
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{$student['name']}}</td>
                                            <td>{{$student['surname']}}</td>
                                            <td><a href="mailto:{{$student['email']}}">{{$student['email']}}</a></td>
                                            <td>{{$student['telephone']}}</td>
                                            <td class="td-actions text-right">
                                                <a rel="tooltip" class="btn btn-success btn-link" href="{{route('student.edit',$student['id'])}}" data-original-title="" title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <a rel="tooltip" class="btn btn-success btn-link" href="{{route('student.show',$student['id'])}}" data-original-title="" title="">
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
