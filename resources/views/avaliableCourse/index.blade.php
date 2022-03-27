@extends('layouts.dashboard')
@section('title')
Avaliable courses
@endsection
@section('PageTitle')
<h3>{{Auth::user()->department->name}}: Available Courses</h3>
<nav>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('Acourse.index')}}">Available Course</a></li>
  </ol>
</nav>

@endsection
@section('content')
<div class="row">

  <div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">
          <a href="{{route('Addcourse.index')}}" class="btn btn-success btn-sm" role="button" aria-pressed="true">
            Add Available Course
          </a>
        </h5>
        <!-- Table with stripped rows -->
        <div class="table-responsive">
          <table class="table datatable table-hover">

            <thead>
              <tr>
                <th>Course</th>
                <th>Tutor </th>
                <th>Department</th>
                <th>Location</th>
                <th>Date</th>
                <th>Time</th>
                <th>Action</th>

              </tr>
            </thead>
            <tbody>
              @foreach($Dep_Courses as $Dep_Course)
              <tr>
                <td>{{$Dep_Course->course->name }}</td>
                <td>{{$Dep_Course->tutor->gettutorname->fullname }}</td>
                <td>{{$Dep_Course->course->departmentname->name }} </td>
                <td>{{$Dep_Course->location}}</td>
                <td>{{$Dep_Course->day}}</td>
                <td>{{$Dep_Course->time}}:00</td>
                <td>
                  <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#course_delete{{$Dep_Course->id}}" title="Delete course"><i class="bi bi-exclamation-triangle"></i></button>
                </td>

                <div class="modal fade" id="course_delete{{$Dep_Course->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  @include('avaliableCourse.DeleteAVCourse')
                </div>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection