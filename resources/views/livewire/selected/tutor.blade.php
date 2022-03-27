<div class="row">
    <div class="col-md-12">
        <div class="p-1 float-start">
        <span><strong>{{$selectedCourse->name}}</strong></span>
        
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
                $wdays=array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
                for ($i=0; $i < sizeof($Ttimes) ; $i++)
                {
                echo '<tr>';
                
                    echo "<td>".$Ttimes[$i].":00</td>";
                    for ($x=0; $x<sizeof($wdays) ; $x++)
                    {
                    $avcourse=0;
                    echo '<td>';
                    foreach($booking_TutCourse as $ct){
                        
                        if($Ttimes[$i]==$ct->time and $wdays[$x]==$ct->day)
                        { 
                            $avcourse++;
                            $checkbooking=0;
                            if($booked){
                                foreach($booked as $is_booked)
                                {
                                    if($Ttimes[$i]==$is_booked->AvaliableCourse->time and $wdays[$x]==$is_booked->AvaliableCourse->day)
                                    {
                                        $checkbooking=1;
                                    
                                        echo '<div class="d-flex flex-column">';
                                            echo'<a href="#" data-bs-toggle="modal" data-bs-target="#Adddaytime'.$Ttimes[$i].$wdays[$x].$avcourse.'">
                                            <div class="imag-contents">
                                                <img src='.URL::asset('/storage/images/'.$ct->tutor->gettutorname->photo.'').' alt="Profile" class="avatar">
                                                <div class="name">'.$ct->tutor->gettutorname->fullname.'</div>
                                            </div>
                                            </a>';         
                                            echo '<div class="modal fade" id="Adddaytime'.$Ttimes[$i].$wdays[$x].$avcourse.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                                                    ?>@include('student.booking.Selected.alreadybooked')
                                                <?php echo'</div>';
                                        echo '</div>';

                                    }

                                }
                            }
                            if($checkbooking==0)
                            {
                                echo '<div class="d-flex flex-column">';
                                    echo'<a href="#" data-bs-toggle="modal" data-bs-target="#Adddaytime'.$Ttimes[$i].$wdays[$x].$avcourse.'">
                                    <div class="imag-contents">
                                        <img src='.URL::asset('/storage/images/'.$ct->tutor->gettutorname->photo.'').' alt="Profile" class="avatar">
                                        <div class="name">'.$ct->tutor->gettutorname->fullname.'</div>
                                    </div>
                                    </a>';         
                                    echo '<div class="modal fade" id="Adddaytime'.$Ttimes[$i].$wdays[$x].$avcourse.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                                            ?>@include('student.booking.Selected.Add')
                                        <?php echo'</div>';
                                echo '</div>';
                            }
                        }
                    }
                    echo '</td>';         

                    }
                echo '</tr>'; 
                }      
            ?>
    
        </tbody>
    </table> 
</div>  