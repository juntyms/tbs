<div class="row">
<div class="col-md-12">
    <div class="p-1 float-start">
    <span><strong>{{$tut_id->gettutorname->fullname}}</strong></span>
     
    </div>
</div>
</div>

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
                $Ttimes=array(8,9,10,11,12,13,14,15);
                $wdays=array('Sunday','Monday','Tuseday','Wednesday','Thursday','Friday','Saturday');
                for ($i=0; $i < sizeof($Ttimes) ; $i++)
                {
                echo '<tr>';
                
                    echo "<td>".$Ttimes[$i].":00</td>";
                    for ($x=0; $x<sizeof($wdays) ; $x++)
                    {
                        $avcourse=1;
                        foreach($booking_TutCourse as $ct){
                            if($Ttimes[$i]==$ct->time and $wdays[$x]==$ct->day)
                            {
                                $checkbooking=0;
                                if($booked){
                                    foreach($booked as $is_booked)
                                    {
                                        if($Ttimes[$i]==$is_booked->AvaliableCourse->time and $wdays[$x]==$is_booked->AvaliableCourse->day)
                                        {
                                            $checkbooking=1;
                                            $avcourse=0;
                                            
                                            echo '<td><button type="button" class="btn btn-primary" style="height:80px; width:95px;"
                                            
                                            data-bs-toggle="modal" data-bs-target="#addcourse'.$Ttimes[$i].$wdays[$x].'" title="Delete "><h6 class="m-b-20">'.$ct->course->name.'</h6></button>';
                                        
                                            echo '<div class="modal fade" id="addcourse'.$Ttimes[$i].$wdays[$x].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                                        
                                                ?>@include('student.booking.Selected.alreadybooked')<?php
                                            echo '</div>';
                                            echo '</td>';
                                        }
                                    }
                                    if($checkbooking==0)
                                    {
                                        $avcourse=0;
                                        
                                        echo '<td><button type="button" class="btn btn-primary" style="height:80px; width:95px;"
                                        
                                        data-bs-toggle="modal" data-bs-target="#addcourse'.$Ttimes[$i].$wdays[$x].'" title="Delete "><h6 class="m-b-20">'.$ct->course->name.'</h6></button>';
                                    
                                        echo '<div class="modal fade" id="addcourse'.$Ttimes[$i].$wdays[$x].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                                    
                                            ?>@include('student.booking.Selected.Add')<?php
                                        echo '</div>';
                                        echo '</td>';
                                    }
                                }
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