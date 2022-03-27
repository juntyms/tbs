@extends('layouts.dashboard')

@section('cutomcss')
<script src='//production-assets.codepen.io/assets/editor/live/console_runner-079c09a0e3b9ff743e39ee2d5637b9216b3545af0de366d4b9aad9dc87e26bfd.js'></script>
<script src='//production-assets.codepen.io/assets/editor/live/events_runner-73716630c22bbc8cff4bd0f07b135f00a0bdc5d14629260c3ec49e5606f98fdd.js'></script>
<script src='//production-assets.codepen.io/assets/editor/live/css_live_reload_init-2c0dc5167d60a5af3ee189d570b1835129687ea2a61bee3513dee3a50c115a77.js'></script>
<meta charset='UTF-8'>
<meta name="robots" content="noindex">
<link rel="shortcut icon" type="image/x-icon" href="//production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />
<link rel="mask-icon" type="" href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
<link rel="canonical" href="https://codepen.io/emilcarlsson/pen/ZOQZaV?limit=all&page=74&q=contact+" />
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,300' rel='stylesheet' type='text/css'>

<script src="https://use.typekit.net/hoy3lrg.js"></script>
<script>
  try {
    Typekit.load({
      async: true
    });
  } catch (e) {}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title')
current requests
@endsection
@section('PageTitle')
<h3> Current Requested Tutorials</h3>
<nav>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('Tutor.tutorial.list')}}">Current Requests</a></li>
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
                        <th>Student</th>
                        <th>Day/Time</th>
                        <th>Location</th>
                        <th>Link</th>
                        <th>Status</th>
                        <th>Comments</th>

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
</div>
@endsection