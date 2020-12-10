@extends('layouts.app', ['activePage' => 'schoolyear', 'titlePage' => __('School Years')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">School Years details</h4>
                        <p class="card-category"> Here you can see the details of a school year</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{route('schoolyear.index')}}" class="btn btn-sm btn-primary">Back to the list</a>
                            </div>
                        </div>
                            <!-- if there are creation errors, they will show here -->
                            {{ Html::ul($errors->all()) }}

                            <div class="form-group">
                                {{ Form::label('schoolyear_id', 'School Year') }}
                                {{ Form::select('schoolyear_id', array_merge(\App\Models\SchoolYear::alldropdown()),$schoolYear->id, array('class'=>'form-control','onchange'=>'loadclassrooms(this.value)'))}}

                            </div>
                        <h3>Classrooms</h3>
                            <div class="row" id="classroomslist">

                            </div>
                        <h2 id="classroomc"></h2>
                        <div class="row">
                            <div class="col-md-12" id="teacherslist"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" id="studentslist"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            loadclassrooms({{$schoolYear->id}});
        });
        function loadclassrooms(id) {
            $.ajax({
                url: "/schoolyear/getClassrooms/" + id,
                type: "GET",
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    // setting a timeout
                    $("#classroomslist").html('Loading..');
                    $("#teacherslist").html('');
                    $("#studentslist").html('');
                },
                success: function(dataResult){
                    var resultData = dataResult.data;
                    var bodyData = '';
                    var i=1;
                    $.each(resultData,function(index,row){
                        bodyData+="<div class=\"col-md-4\">";
                        bodyData+="<button class=\"btn btn-primary btn-round\" onclick=\"$('#classroomc').html('" + row.name + "');loadclassroomteachers(" + row.id + ");loadclassroomstudents(" + row.id + ");\">";
                        bodyData+=row.name;
                        bodyData+="</button>";
                        bodyData+="</div>";

                    })
                    $("#classroomslist").html(bodyData);
                }
            });
        }
        function loadclassroomteachers(id) {
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
                    bodyData+="<h3>Teachers</h3><ul>";
                    $.each(resultData,function(index,row){

                        bodyData+="<li>";
                        bodyData+=row.name + " " + row.surname;
                        bodyData+="</li>";

                    })
                    bodyData+="</ul>";
                    $("#teacherslist").html(bodyData);
                }
            });
        }
        function loadclassroomstudents(id) {
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
                    bodyData+="<h3>Students</h3><ul>";
                    $.each(resultData,function(index,row){

                        bodyData+="<li>";
                        bodyData+=row.name + " " + row.surname;
                        bodyData+="</li>";

                    })
                    bodyData+="</ul>";
                    $("#studentslist").html(bodyData);
                }
            });
        }
    </script>
@endpush
