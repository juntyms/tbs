@extends('layouts.dashboard')
@section('title')
Booking Select Department
@endsection
@section('PageTitle')
    <h3><strong>{{$dep->name}}</strong>:<span> Available Course</span></h3>
      
    
@endsection
@section('content')

<div class="container">

    <div class="row">
        <div class="sec-title text-center">
		    <h2>{{$course->code}} - {{$course->name}}	</h2>
		</div>
		<br>
        <?php $x = 0;?>
        <?php $is_booked=[];?>
       
        @foreach($avcourses as $ct)
            @if($listbooked)
                @foreach($listbooked as $booked)
                    @if(($booked->AvaliableCourse->day == $ct->day )&&($booked->AvaliableCourse->time == $ct->time))
                        <?php $x = 1;?>
                        <?php $is_booked=$booked;?>
                    
                    @endif
               @endforeach
            @endif

            @if($x==1)
                <figure class="team-member btn-sm col-md-3 col-sm-6 col-xs-12 text-center" style="background-color:#084C61;">
                    <div class="box" style="background-color:#084C61;">

                        <br>
                        <img class="img" src="{{asset('/storage/images/'.$ct->tutor->gettutorname->photo)}}">
                        <div class="name text-white">{{$ct->tutor->gettutorname->fullname}}</div> <br>
                        @if($ct->tutor->is_student==1)

                            <div class="position">Peer Tutor </div> <br> 
                        @else
                            <div class="position">Lecturer </div> <br>
                        @endif

                        
                        <div class="location">{{$ct->time}}.00-{{$ct->time+1}}.00 | {{$ct->day}}</div> <br> 							
                        <div class="location">ON CAMPUS {{$ct->location}} </div> <br> 
                        <div class="location"> <a class="btnclick" style="background-color:#177E89;" data-bs-toggle="modal" data-bs-target="#addcourse{{$ct->id}}" href="">Booking</a></div>	
                        <br>
                    </div>

                </figure>
               
            
        
                <div class="modal fade" id="addcourse{{$ct->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">;
                    @include('student.booking.Selected.alreadybooked')
                </div>
                <?php $x = 0;?>
                <?php $is_booked=[];?>

            
            @else
                <figure class="team-member btn-sm col-md-3 col-sm-6 col-xs-12 text-center" style="background-color:#084C61;">
                    <div class="box" style="background-color:#084C61;">

                        <br>
                        <img class="img" src="{{asset('/storage/images/'.$ct->tutor->gettutorname->photo)}}">
                        <div class="name text-white">{{$ct->tutor->gettutorname->fullname}}</div> <br>
                        @if($ct->tutor->is_student==1)

                            <div class="position">Peer Tutor </div> <br> 
                        @else
                            <div class="position">Lecturer </div> <br>
                        @endif

                        
                        <div class="location">{{$ct->time}}.00-{{$ct->time+1}}.00 | {{$ct->day}}</div> <br> 							
                        <div class="location">ON CAMPUS {{$ct->location}} </div> <br> 	
                        <div class="location"> <a href="" class="btnclick" style="background-color:#177E89;" data-bs-toggle="modal" data-bs-target="#addcourse{{$ct->id}}">Booking</a></div>
                        <br> 
                    </div>

                </figure>
            
        
                <div class="modal fade" id="addcourse{{$ct->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">;
                                            
                   @include('student.booking.Selected.Add')
                </div>
                <?php $x = 0;?>
                <?php $is_booked=[];?>
            
            @endif
            
                                         
        @endforeach
    
    </div>
</div>
@endsection