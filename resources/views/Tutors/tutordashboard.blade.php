@extends('layouts.dashboard')
@section('title')
All requests
@endsection
@section('PageTitle')
    <h3> Requested Tutorials</h3>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
          
        </ol>
      </nav>
    </div><!-- End Page Title -->
@endsection
@section('content')
<div class="row">

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item mb-3 mt-3">
                        <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed text-white"style="background-color:#084C61;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Current Requests
                        </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">

                                <div class="table-responsive">
                                    <table class="table datatable table-hover">
                                        <thead>
                                            <tr class="bg-warning text-white">
                                                <th class="text-center">Tutorial ID</th>
                                                <th class="text-center">Course</th>
                                                <th class="text-center">Student</th>
                                                <th class="text-center">Day/Time</th>
                                                <th class="text-center">Location</th>
                                                <th class="text-center">Link</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Comments</th>

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
                                                    @if($list->AvaliableCourse->link)
                                                    <td><a href="{{$list->AvaliableCourse->link}}" target="_blank">click here</a></td>
                                                    @else
                                                    <td></td>
                                                    @endif
                                                    @if($list->accepted==0)
                                                    <td>
                                                    <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#status{{$list->id}}" title="satus"><i class="ri-add-circle-line"></i></button>
                                                        <div class="modal fade" id="status{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                                                            @include('Tutors.status')
                                                        </div>
                                                    </td>
                                                    @elseif($list->accepted==1)
                                                    <td><button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#status{{$list->id}}" title="satus"><i class="ri-pencil-line"></i></button>
                                                        <div class="modal fade" id="status{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                                                            @include('Tutors.status')
                                                        </div>
                                                    </td>
                                                    @elseif($list->accepted==2)
                                                    <td>Rejected</td>
                                                    @elseif($list->accepted==3)
                                                    <td>completed</td>
                                                    @elseif($list->accepted==4)Rejected
                                                    <td>incompleted</td>
                                                    @endif
                                                    <td>
                                                        <button type="button" class="btn btn-info btn-md" data-bs-toggle="modal" data-bs-target="#commentt{{$list->id}}" title="comments"><i class="ri-mail-line"></i></button>
                                                    </td>
                                                    <div class="modal fade" id="commentt{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        @include('comments.comtutor')
                                                    </div>
                                                    
                                                </tr>

                            

                                            @endforeach
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed text-white "style="background-color:#084C61;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            All Request
                        </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table datatable table-hover">

                                    <thead>
                                        <tr class="bg-warning text-white">
                                            <th class="text-center">Tutorial ID</th>
                                            <th class="text-center">Course</th>
                                            <th class="text-center">Student Name</th>
                                            <th class="text-center">Day/Time</th>
                                            <th class="text-center">Location</th>
                                            <th class="text-center">Status</th>
                                        
                                        </tr>
                                    </thead>
                                        <tbody>
                                            @foreach($Alllists as $list)
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


    
            </div>
        </div>
    </div>
</div>
@endsection


                                        