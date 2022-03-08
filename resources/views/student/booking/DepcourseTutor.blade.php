@extends('layouts.dashboard')
@section('title')
Booking Select Department
@endsection
@section('PageTitle')
    <h3>Availabele Course : Tutor </h3>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('student.booking.Department')}}">Booking</a></li>
        </ol>
      </nav>
    
@endsection
@section('content')

<div class="container">

    <div class="row">
        <div class="sec-title text-center">
		    <h2>{{$course->code}} - {{$course->name}}	</h2>
		</div>
		<br>
        @foreach($avcourses as $ct)
         
            <figure class="team-member btn-sm col-md-3 col-sm-6 col-xs-12 text-center" data-bs-toggle="modal" data-bs-target="#addcourse{{$ct->id}}">
                <div class="box">

                    <br>
                    <img class="img" src="{{asset('/storage/images/'.$ct->tutor->gettutorname->photo)}}">
                    <div class="name">{{$ct->tutor->gettutorname->fullname}}</div> <br>
                    @if($ct->tutor->gettutorname->is_student==1)

                        <div class="position">Student </div> <br> 
                    @else
                        <div class="position">Lecturer </div> <br>
                    @endif

                    
                    <div class="location">{{$ct->time}}.00-{{$ct->time+1}}.00 | {{$ct->day}}</div> <br> 							
                    <div class="location">ON CAMPUS {{$ct->location}} </div> <br> 	
                </div>

            </figure>
        
       
        <div class="modal fade" id="addcourse{{$ct->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">;
                                    
            @include('student.booking.Selected.Add')
        </div>
                                         
        @endforeach
    
    </div>
</div>

                   
@endsection

                                        