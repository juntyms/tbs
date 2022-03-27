@extends('layouts.dashboard')
@section('title')
All requests
@endsection
@section('PageTitle')
    <h3> All Requested Tutorials</h3>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('Tutor.tutorial.allRequest')}}">All Requests</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
@endsection
@section('content')
<div class="row">

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
              <!-- Table with stripped rows -->
              <div class="table-responsive">
                <table class="table datatable table-hover">

                    <thead>
                    <tr>
                        <th>Tutorial ID</th>
                        <th>Course</th>
                        <th>Student Name</th>
                        <th>Day/Time</th>
                        <th>Location</th>
                        <th>Status</th>
                       
                    </tr>
                    </thead>
                    <tbody>
                            @foreach($lists as $list)
                                <tr>
                                    <td>{{$list->id}}</td>
                                    <td>{{$list->AvaliableCourse->course->name}}</td>
                                    <td>{{$list->student->fullname}} </td>
                                    <td>{{$list->AvaliableCourse->day}}-{{$list->AvaliableCourse->time}}:00</td>
                                    <td>{{$list->AvaliableCourse->location}}</td>
                                    @if($list->accepted==0)
                                      <td>Waiting Approval</td>
                                    @elseif($list->accepted==1)
                                      <td>Approved</td>
                                      @elseif($list->accepted==2)
                                      <td>Rejected</td>
                                      @elseif($list->accepted==3)
                                        <td>Completed</td>
                                      @elseif($list->accepted==4)
                                        <td>Incomplete</td>
                                    @endif
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


                                        