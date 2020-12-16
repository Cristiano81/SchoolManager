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
                        <p class="card-category"> Here you can build a classroom</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{route('classroom.index')}}" class="btn btn-sm btn-primary">Back to the list</a>
                            </div>
                        </div>
                        <!-- if there are creation errors, they will show here -->
                        {{ Html::ul($errors->all()) }}

                        {{ Form::open(array('method'=>'PUT','route' => ['classroom.update',$classroom->id])) }}
                        <h2>    School Year
                            {{ App\Models\SchoolYear::getname($classroom->schoolyear_id)}}</h2>

                        <h2>
                            Classroom
                            {{  $classroom->name }}
                        </h2>
                        <h2>Teachers</h2>
                        <div class="form-group">
                            <div id="teacherslist"></div>
                            {{Form::text('searcht','Search a teacher', array('class' => 'form-control','onkeyup' => 'searchteacher(this.value)'))}}
                            <div id="found-teachers"></div>
                        </div>
                        <h2>Students</h2>
                        <div class="form-group">
                            <div id="studentslist"></div>
                            {{Form::text('searchs','Search a student', array('class' => 'form-control','onkeyup' => 'searchstudent(this.value)'))}}
                            <div id="found-students"></div>
                        </div>

                        {{ Form::submit('SAVE', array('class' => 'btn btn-default','onclick'=>'return confirm(\'Are you sure?\');')) }}

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            loadteachers({{$classroom->id}});
            loadstudents({{$classroom->id}});
        });
        function searchteacher(q) {
            if (q.length <= 3) {
                $("#found-teachers").html('');
                return;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/teacher/search",
                type:'POST',
                data: {
                  q:q
                },
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    // setting a timeout
                    $("#found-teachers").html('Loading..');
                },
                success: function(dataResult){
                    var resultData = dataResult.data;
                    var bodyData = '';
                    var i=0;
                    bodyData+="<ul>";
                    $.each(resultData,function(index,row){

                        bodyData+="<li>";
                        bodyData+=row.name + " " + row.surname + " email " + row.email + " telephone " + row.telephone + " <a href=\"javascript:void(0)\" onclick=\"addteacher(" + row.id + ")\" class=\"btn btn-default\">Add</a>";
                        bodyData+="</li>";
                        i++;
                    })
                    bodyData+="</ul>";
                    if (!i)
                        bodyData ="No teachers found";
                    $("#found-teachers").html(bodyData);
                },
                error: function(a,b,c) {
                    //alert (a);
                }
            });
        }
        function addteacher(teacherid) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/classroom/attachTeacher",
                type:'POST',
                data: {
                    classroomid:{{$classroom->id}},
                    teacherid:teacherid
                },
                cache: false,
                dataType: 'json',
                complete: function(){
                    loadteachers({{$classroom->id}});
                },
                error: function(a,b,c) {
                    //alert (a);
                }
            });
        }
        function searchstudent(q) {
            if (q.length <= 3) {
                $("#found-students").html('');
                return;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/student/search",
                type:'POST',
                data: {
                    q:q
                },
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    // setting a timeout
                    $("#found-students").html('Loading..');
                },
                success: function(dataResult){
                    var resultData = dataResult.data;
                    var bodyData = '';
                    var i=0;
                    bodyData+="<ul>";
                    $.each(resultData,function(index,row){

                        bodyData+="<li>";
                        bodyData+=row.name + " " + row.surname + " email " + row.email + " telephone " + row.telephone  + " <a href=\"javascript:void(0)\" onclick=\"addstudent(" + row.id + ")\" class=\"btn btn-default\">Add</a>";
                        bodyData+="</li>";
                        i++;
                    })
                    bodyData+="</ul>";
                    if (!i)
                        bodyData ="No teachers found";
                    $("#found-students").html(bodyData);
                },
                error: function(a,b,c) {
                    //alert (a);
                }
            });
        }
        function addstudent(studentid) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/classroom/attachStudent",
                type:'POST',
                data: {
                    classroomid:{{$classroom->id}},
                    studentid:studentid
                },
                cache: false,
                dataType: 'json',
                complete: function(){
                    loadstudents({{$classroom->id}});
                },
                error: function(a,b,c) {
                    //alert (a);
                }
            });
        }
        function loadteachers(id) {
            $.ajax({
                url: "/classroom/getTeachers/" + id,
                type: "GET",
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    // setting a timeout
                    $("#teacherslist").html('Loading..');
                },
                success: function(dataResult){
                    var resultData = dataResult.data;
                    var bodyData = '';
                    var i=1;
                    bodyData+="<ul>";
                    $.each(resultData,function(index,row){

                        bodyData+="<li>";
                        bodyData+=row.name + " " + row.surname + " email " + row.email + " telephone " + row.telephone + " <a href=\"javascript:void(0)\" onclick=\"removeteacher(" + row.id + ")\" class=\"btn btn-default\">Remove</a>";
                        bodyData+="</li>";

                    })
                    bodyData+="</ul>";
                    $("#teacherslist").html(bodyData);
                }
            });
        }
        function removeteacher(teacherid) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/classroom/detachTeacher",
                type:'POST',
                data: {
                    classroomid:{{$classroom->id}},
                    teacherid:teacherid
                },
                cache: false,
                dataType: 'json',
                complete: function(){
                    loadteachers({{$classroom->id}});
                },
                error: function(a,b,c) {
                    //alert (a);
                }
            });
        }
        function loadstudents(id) {
            $.ajax({
                url: "/classroom/getStudents/" + id,
                type: "GET",
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    // setting a timeout
                    $("#studentslist").html('Loading..');
                },
                success: function(dataResult){
                    var resultData = dataResult.data;
                    var bodyData = '';
                    var i=1;
                    bodyData+="<ul>";
                    $.each(resultData,function(index,row){

                        bodyData+="<li>";
                        bodyData+=row.name + " " + row.surname + " email " + row.email + " telephone " + row.telephone  + " <a href=\"javascript:void(0)\" onclick=\"removestudent(" + row.id + ")\" class=\"btn btn-default\">Remove</a>";
                        bodyData+="</li>";

                    })
                    bodyData+="</ul>";
                    $("#studentslist").html(bodyData);
                }
            });
        }
        function removestudent(studentid) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/classroom/detachStudent",
                type:'POST',
                data: {
                    classroomid:{{$classroom->id}},
                    studentid:studentid
                },
                cache: false,
                dataType: 'json',
                complete: function(){
                    loadstudents({{$classroom->id}});
                },
                error: function(a,b,c) {
                    //alert (a);
                }
            });
        }
    </script>
@endpush
