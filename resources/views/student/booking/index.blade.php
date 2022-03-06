@extends('layouts.dashboard')
@section('title')
Booking Select Department
@endsection
@section('PageTitle')
    <h3>booking Tutorial: Select Department </h3>
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

        <a class="col-md-6 col-xl-3"  href="{{route('deplistAv',$dep)}}">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">{{$dep->name}} </h6>
                    <h4 class="text-right"><i class="bi bi-journal-text f-left"></i><span>Turtorials</span></h4>
                    <p class="m-b-0"><span class="f-right">{{$dep->Available()->where('available_courses.active',1)->count()}}</span></p>
                </div>
            </div>
        </a>
      @endif
    @endforeach
</div>

                   
@endsection

                                        