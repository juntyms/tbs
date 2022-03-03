@extends('layouts.dashboard')
@section('title')
Booking Select Tutor-Course
@endsection
@section('PageTitle')
    <h3> {{$dep->name}}: avaliable courses</h3>
    <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('student.booking.Department')}}">Booking</a></li>
          <li class="breadcrumb-item"><a href="#">options</a></li>
        </ol>
    </nav>
@endsection
@section('content')
<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    Select Tutor/Course
                </h5>
                <div class="card-title">
                        {{ Form::open(['route'=>['student.booking.option',$dep]]) }}
                            <div class="row">
                                <div class="col-lg-7 mb-3">
                                    {{ Form::select('selectT',$Serchtutor,null,['class' => 'test form-control','placeholder' => 'Selected Tutor']) }}
                
                                    <br><br>
                                    {{ Form::select('selectC',$courses,null,['class' => 'test form-control','placeholder' => 'Selected course']) }}
                                </div>
                                            
                                <div class="col-lg-5 mt-3">
                                    <button  type="submit"class="btn btn-primary" style="height:30px; width:100px;">Select</button>
                                </div>
                            </div>
                        {{ Form::close() }}
                        <!--
                        <form  action="{{route('student.booking.option',$dep)}}" method="POST">
                            @csrf
                            <div class="row">
                                

                                <div class="col-lg-7 mb-3">
                                    <select class="livesearch form-control mb-1" id="livesearch" name="livesearch[]"></select>
                                    <br><br>
                                    <select class="livesearch2 form-control" id="livesearch2" name="livesearch2[]"></select>
                                </div>
                            
                                <div class="col-lg-5 mt-3">
                                    <button  type="submit"class="btn btn-primary" style="height:30px; width:100px;">Select</button>
                                </div>
                            </div>
                            
                        </form>
                        !-->
                </div>
                @if($show1)
                    @include('student.booking.Selected.course')

                @elseif($show2)
                    @include('student.booking.Selected.tutor')

                @elseif($show3)
                    @include('student.booking.Selected.CourseTutor')

                @endif
                <!-- Table with stripped rows -->
            </div> 
        </div>
    </div>
</div>    
               
@endsection
@section('customjs')
<script type="text/javascript">
    $('.livesearch').select2({
        placeholder: "Select Tutor",
        ajax: {
            url: "{{route('autoselect',$dep)}}",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.fullname,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

    $('.test').select2();
</script>
<script type="text/javascript">
    $('.livesearch2').select2({
        placeholder: "Select Course",
        ajax: {
            url: "{{route('autoCourses',$dep)}}",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
</script>
<script>
    CKEDITOR.replace( 'editor1' );
 </script>
@endsection

