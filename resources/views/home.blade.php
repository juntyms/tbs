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
    <a class="col-md-6 col-xl-3" href="{{route('AcadmicY.index')}}">
        <div class="card bg-c-blue order-card">
            <div class="card-block">
                <h6 class="m-b-20">Academic Years</h6>
                <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span></span></h4>
                <p class="m-b-0"><span class="f-right"></span></p>
            </div>
        </div>
    </a>
    @endcan
    @can('user-list')


    <a class="col-md-6 col-xl-3" href="{{ url('/'.($page ='users')) }}">
        <div class="card bg-R-blue order-card ">
            <div class="card-block">
                <h6 class="m-b-20">SCT-User</h6>
                <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span></span></h4>
                <p class="m-b-0"><span class="f-right"></span></p>
            </div>
        </div>
    </a>
    @endcan
    @can('role-list')
    <a class="col-md-6 col-xl-3" href="{{ url('/'.($page ='roles')) }}">
        <div class="card bg-c-blue order-card">
            <div class="card-block">
                <h6 class="m-b-20">System Roles</h6>
                <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span></span></h4>
                <p class="m-b-0"><span class="f-right"></span></p>
            </div>
        </div>
    </a>
    @endcan
    @can('dep-user')
    <a class="col-md-6 col-xl-3" href="{{route('user.index')}}">
        <div class="card bg-R-blue order-card">
            <div class="card-block">
                <h6 class="m-b-20">Department Users</h6>
                <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span></span></h4>
                <p class="m-b-0"><span class="f-right"></span></p>
            </div>
        </div>

    </a>
    @endcan
    @can('dep-course')
    <a class="col-md-6 col-xl-3" href="{{route('course.index')}}">
        <div class="card bg-c-blue order-card">
            <div class="card-block">
                <h6 class="m-b-20">Department Courses</h6>
                <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span></span></h4>
                <p class="m-b-0"><span class="f-right"></span></p>
            </div>
        </div>
    </a>
    @endcan
    @can('dep-tutor-list')
    <a class="col-md-6 col-xl-3" href="{{route('user.tutor')}}">
        <div class="card bg-R-blue order-card">
            <div class="card-block">
                <h6 class="m-b-20">Department Tutors</h6>
                <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span></span></h4>
                <p class="m-b-0"><span class="f-right"></span></p>
            </div>
        </div>
    </a>
    @endcan
    @can('dep-AVcourse-list')
    <a class="col-md-6 col-xl-3" href="{{route('Acourse.index')}}">
        <div class="card bg-c-blue order-card">
            <div class="card-block">
                <h6 class="m-b-20">Department Available Course</h6>
                <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span></span></h4>
                <p class="m-b-0"><span class="f-right"></span></p>
            </div>
        </div>
    </a>
    @endcan
    @can('booking')
    <a class="col-md-6 col-xl-3" href="{{route('student.booking.Department')}}">
        <div class="card bg-R-blue order-card">
            <div class="card-block">
                <h6 class="m-b-20">Booking</h6>
                <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span></span></h4>
                <p class="m-b-0"><span class="f-right"></span></p>
            </div>
        </div>
    </a>
    @endcan
    @can('student-schedule')
    <a class="col-md-6 col-xl-3" href="{{route('student.tutorial.timetable')}}">
        <div class="card bg-R-blue order-card">
            <div class="card-block">
                <h6 class="m-b-20">Student Timetable</h6>
                <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span></span></h4>
                <p class="m-b-0"><span class="f-right"></span></p>
            </div>
        </div>
    </a>
    @endcan


    @can('student-tutorials')
    <a class="col-md-6 col-xl-3" href="{{route('student.tutorial.list')}}">
        <div class="card bg-c-blue order-card">
            <div class="card-block">
                <h6 class="m-b-20">Current Tutorials</h6>
                <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span></span></h4>
                <p class="m-b-0"><span class="f-right"></span></p>
            </div>
        </div>
    </a>

    @endcan
    @can('student-tutorials')
    <a class="col-md-6 col-xl-3" href="{{route('student.tutorial.alllist')}}">
        <div class="card bg-R-blue order-card">
            <div class="card-block">
                <h6 class="m-b-20">All Tutorials</h6>
                <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span></span></h4>
                <p class="m-b-0"><span class="f-right"></span></p>
            </div>
        </div>
    </a>
    @endcan
    @can('tutor-tutorials')
    <a class="col-md-6 col-xl-3" href="{{route('Tutor.tutorial.timetable')}}">
        <div class="card bg-c-blue order-card">
            <div class="card-block">
                <h6 class="m-b-20">Tutor Timetable</h6>
                <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span></span></h4>
                <p class="m-b-0"><span class="f-right"></span></p>
            </div>
        </div>
    </a>
    @endcan
    @can('tutor-tutorials')
    <a class="col-md-6 col-xl-3" href="{{route('Tutor.tutorial.list')}}">
        <div class="card bg-R-blue order-card">
            <div class="card-block">
                <h6 class="m-b-20">Current Requests</h6>
                <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span></span></h4>
                <p class="m-b-0"><span class="f-right"></span></p>
            </div>
        </div>
    </a>
    @endcan
    @can('tutor-tutorials')
    <a class="col-md-6 col-xl-3" href="{{route('Tutor.tutorial.allRequest')}}">
        <div class="card bg-c-blue order-card">
            <div class="card-block">
                <h6 class="m-b-20">All Requests</h6>
                <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span></span></h4>
                <p class="m-b-0"><span class="f-right"></span></p>
            </div>
        </div>
    </a>
    @endcan
    @can('TBS-managment')
    <a class="col-md-6 col-xl-3" href="{{route('Report.Departments')}}">
        <div class="card bg-c-blue order-card">
            <div class="card-block">
                <h6 class="m-b-20">View Report</h6>
                <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span></span></h4>
                <p class="m-b-0"><span class="f-right"></span></p>
            </div>
        </div>
    </a>
    @endcan

</div>


@endsection