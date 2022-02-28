@extends('layouts.dashboard')
@section('title')
Booking Select Department
@endsection
@section('PageTitle')
    <h3>Dashboard </h3>
    
@endsection
@section('content')
    <div class="row">
    @can('acadmicyear-list')
        <a class="col-md-6 col-xl-3"  href="{{route('AcadmicY.index')}}">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Acadmic Years</h6>
                    <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span></span></h4>
                    <p class="m-b-0"><span class="f-right"></span></p>
                </div>
            </div>
        </a>
        @endcan
        
       
        <a class="col-md-6 col-xl-3"  href="{{ url('/'.($page ='users')) }}">
            <div class="card bg-R-blue order-card ">
                <div class="card-block">
                    <h6 class="m-b-20">SCT-User</h6>
                    <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span></span></h4>
                    <p class="m-b-0"><span class="f-right"></span></p>
                </div>
            </div>
        </a>
        <a class="col-md-6 col-xl-3"  href="{{ url('/'.($page ='roles')) }}">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">System Roles</h6>
                    <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span></span></h4>
                    <p class="m-b-0"><span class="f-right"></span></p>
                </div>
            </div>
        </a>
        <a class="col-md-6 col-xl-3"  href="{{route('user.index')}}">
            <div class="card bg-R-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Department users</h6>
                    <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span></span></h4>
                    <p class="m-b-0"><span class="f-right"></span></p>
                </div>
            </div>
        </a>
        <a class="col-md-6 col-xl-3"  href="{{route('course.index')}}">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Department Courses</h6>
                    <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span></span></h4>
                    <p class="m-b-0"><span class="f-right"></span></p>
                </div>
            </div>
        </a>
        <a class="col-md-6 col-xl-3"  href="{{route('user.tutor')}}">
            <div class="card bg-R-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Department Tutors</h6>
                    <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span></span></h4>
                    <p class="m-b-0"><span class="f-right"></span></p>
                </div>
            </div>
        </a>
        <a class="col-md-6 col-xl-3"  href="{{route('Acourse.index')}}">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Department Avaliable course</h6>
                    <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span></span></h4>
                    <p class="m-b-0"><span class="f-right"></span></p>
                </div>
            </div>
        </a>
        <a class="col-md-6 col-xl-3"  href="">
            <div class="card bg-R-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">booking</h6>
                    <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span></span></h4>
                    <p class="m-b-0"><span class="f-right"></span></p>
                </div>
            </div>
        </a>
       
        <a class="col-md-6 col-xl-3"  href="{{route('student.tutorial.timetable')}}">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Student Timetable</h6>
                    <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span></span></h4>
                    <p class="m-b-0"><span class="f-right"></span></p>
                </div>
            </div>
        </a>
       
        
   
        
    </div>

                   
@endsection

                                        