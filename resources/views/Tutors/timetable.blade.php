@extends('layouts.dashboard')
@section('title')
 requests timetable
@endsection
@section('PageTitle')
    <h3>Request tutorials timetable</h3>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('Tutor.tutorial.timetable')}}">timetable</a></li>
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
                Tutorial timetable
              </h5>
              </h5>
              <!-- Table with stripped rows -->
              
              @if($show_tutorils_time)
                <div class="table-responsive">
                  <table class="table table-bordered border-dark table-striped">

                      <thead>
                      <tr>
                          <th>Time</th>
                          <th>Sunday </th>
                          <th>Monday</th>
                          <th>Tuseday</th>
                          <th>Wednesday</th>
                          <th>Thrusday</th>
                          <th>Friday</th>
                          <th>Satuday</th>
                          
                      </tr>
                      </thead>
                      <tbody>
                    
                      
                          <?php
                              $Ttimes=array(8,9,10,11,12,13,14,15,16,17,18,19,20);
                              $wdays=array('Sunday','Monday','Tuseday','Wednesday','Thursday','Friday','Satuday');
                              for ($i=0; $i < sizeof($Ttimes) ; $i++)
                              {
                                echo '<tr>';
                                
                                  echo "<td>".$Ttimes[$i].":00</td>";
                                  for ($x=0; $x<sizeof($wdays) ; $x++)
                                  {
                                    $avcourse=1;
                                    foreach($lists as $list){
                                        if($Ttimes[$i]==$list->time and $wdays[$x]==$list->day)
                                        {
                                            echo '<td class="bg-primary text-white">';?> <a class="text-white" href="{{route('Tutor.tutorial.getlist',$list->id)}}">{{$list->course->name}}</a><?php echo '</td>';
                                            $avcourse=0;
                                        }
                                      }
                                    if($avcourse==1)
                                    {
                                      echo '<td></td>';

                                    }
                                          

                                  }
                                echo '</tr>'; 
                              }      
                          ?>
                    
                      </tbody>
                  </table> 
                </div>  
              @endif             
            </div>
        </div>
  </div>
</div>
@endsection
