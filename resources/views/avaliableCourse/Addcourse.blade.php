@extends('layouts.dashboard')
@section('title')
Select tutor
@endsection
@section('PageTitle')
    <h3>{{Auth::user()->department->name}}: Add avaliable courses</h3>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('Acourse.index')}}">Avaliable course</a></li>
          <li class="breadcrumb-item"><a href="{{route('Addcourse.index')}}">select tutor</a></li>
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
                Select Tutor
              </h5>
              <h5 class="card-title">
              <form  action="{{route('Addcourse.index')}}" method="POST">
                @csrf
                <div class="row">
                <div class="col-lg-7 mb-3"><select class="livesearch form-control" id="livesearch" name="livesearch[]"></select>
                  
                </div>
                  <div class="col-lg-3">
                    <button  type="submit"class="btn btn-primary" style="height:30px; width:100px;">Select</button>
                  </div>
                </div>
              </form>
              </h5>
              <!-- Table with stripped rows -->
              
              @if($show_AV_time)
                <div class="table-responsive">
                  <table class="table table-bordered border-dark table-striped">

                      <thead>
                      <tr>
                          <th>Time</th>
                          <th>Sunday </th>
                          <th>Monday</th>
                          <th>Tuesday</th>
                          <th>Wednesday</th>
                          <th>Thursday</th>
                          <th>Friday</th>
                          <th>Saturday</th>
                          
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
                                    foreach($Dep_Courses as $Dep_Course){
                                        if($Ttimes[$i]==$Dep_Course->time and $wdays[$x]==$Dep_Course->day)
                                        {
                                            echo '<td><button type="button" class="btn btn-danger" style="height:80px; width:95px;"
                                            
                                            data-bs-toggle="modal" data-bs-target="#Deletedaytime'.$Ttimes[$i].$wdays[$x].'" title="Delete "><h6 class="m-b-20">'.$Dep_Course->course->name.'</h6></button></td>';
                                            $avcourse=0;
                                        }
                                      }
                                    if($avcourse==1)
                                    {
                                      echo '<td><button type="button" class="btn btn-success" style="height:80px; width:95px;
                                      " data-bs-toggle="modal" data-bs-target="#Adddaytime'.$Ttimes[$i].$wdays[$x].'" title="Add "><h6 class="m-b-20">available</h6></button></td>';

                                    }
                                    ?>
                                    <div class="modal fade" id="Adddaytime<?php echo $Ttimes[$i].$wdays[$x];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        @include('avaliableCourse.selectACourse')
                                    </div>
                                    @if($avcourse==0)
                                    <div class="modal fade" id="Deletedaytime<?php echo $Ttimes[$i].$wdays[$x];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        @include('avaliableCourse.DeleteAVCourse')
                                    </div>
                                    @endif
                                    <?php
                                          

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
@section('customjs')
<script type="text/javascript">
    $('.livesearch').select2({
        placeholder: '<?php if($show_AV_time){echo $tutorid->gettutorname->fullname;}else{echo 'Select Tutor';}?>',
        ajax: {
            url: "{{route('autocomplete')}}",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.fullname,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
</script>
@endsection
