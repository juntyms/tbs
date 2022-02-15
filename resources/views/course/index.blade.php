@extends('layouts.dashboard')
@section('title')
Department courses
@endsection
@section('PageTitle')
    <h3>{{Auth::user()->department->name}}: Department courses</h3>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('course.index')}}">Department course</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
@endsection
@section('content')
<div class="row">

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
              <h5 class="card-title">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <p>{{ $errors->first()}}</p>
                    </div>
                @endif
                <a href="#" class="btn btn-success btn-sm" role="button" aria-pressed="true"  data-bs-toggle="modal" data-bs-target="#Addcourse">
                    Add Course
                </a>
                <div class="modal fade" id="Addcourse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        @include('course.Addcourse')
                </div>
              </h5>
              <!-- Table with stripped rows -->
              <div class="table-responsive">
                <table class="table datatable table-hover">

                    <thead>
                    <tr>
                        <th>Course ID</th>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Course Crated</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                            @foreach($Dep_Courses as $Dep_Course)
                                <tr>
                                    <td>{{$Dep_Course->id }}</td>
                                    <td>{{$Dep_Course->code }}</td>
                                    <td>{{$Dep_Course->name }} </td>
                                    <td>{{$Dep_Course->created_at}}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#user_EditCourse{{$Dep_Course->id}}" title="Edit course"><i class="bi bi-info-circle"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#course_delete{{$Dep_Course->id}}" title="Delete course"><i class="bi bi-exclamation-triangle"></i></button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="user_EditCourse{{$Dep_Course->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                @include('course.EditCourse')
                                </div>
                                <div class="modal fade" id="course_delete{{$Dep_Course->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    @include('course.DeleteCourse')
                                </div>
                            @endforeach
                    </tbody>
                    </table> 
                </div>             
            </div>
        </div>
    </div>
</div>
@endsection

                                        