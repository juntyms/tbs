@extends('layouts.dashboard')
@section('title')
All requests
@endsection
@section('PageTitle')
    <h3> All request Tutorials</h3>
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
                        <th> Course</th>
                        <th>student Name</th>
                        <th>Day/Time</th>
                        <th>location</th>
                        <th>status</th>
                       
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
                                      <td>wating approval</td>
                                    @elseif($list->accepted==1)
                                      <td>approved</td>
                                      @elseif($list->accepted==2)
                                      <td>Rejected</td>
                                      @elseif($list->accepted==3)
                                        <td>completed</td>
                                      @elseif($list->accepted==4)
                                        <td>incompleted</td>
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


                                        