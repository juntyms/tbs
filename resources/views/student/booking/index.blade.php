@extends('layouts.dashboard')
@section('title')
Booking Select Department
@endsection
@section('PageTitle')
<h3>Booking Tutorial: Select Department </h3>
<nav>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('student.booking.Department')}}">Booking</a></li>
  </ol>
</nav>

@endsection
@section('content')
  <div class="row">
    @foreach($deps as $dep)

      @if($dep->Available()->where('available_courses.active',1)->count()>0)

        <a class="col-md-6 col-xl-3" href="{{route('booking.option',$dep)}}">
          <div class="card  order-card" style="background-color:#084C61;">
            <div class="card-block">
                <h6 class="m-b-20"><strong>{{$dep->name}} </strong></h6>
                <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span>Tutorials</span></h4>
                @if($ay)
                  <p class="m-b-0"><span class="f-right">{{$dep->Available()->where('available_courses.active',1)->where('available_courses.ay_id',$ay->id)->count()}}</span></p>
                @else
                  <p class="m-b-0"><span class="f-right">0</span></p>
                @endif

            </div>
          </div>
        </a>
      @endif
    @endforeach
  </div>


@endsection