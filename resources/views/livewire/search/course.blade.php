<div class="table-responsive">
                <table class="table datatable table-hover">
                    <thead>
                    <tr>
                        <th>Course Code</th>
                        <th>Avaliable Course</th>
                        <th>Tutor Name</th>
                        <th>Day/Time</th>
                        <th>Location</th>
                        <th>Total Request</th>
                    
                    </tr>
                    </thead>
                    <tbody>
                        @if($avlists)
                            @foreach($avlists as $avlist)
                                <tr>
                                    <td>{{$avlist->code}}</td>
                                    <td>{{$avlist->course->name}}</td>
                                    <td>{{$avlist->tutor->gettutorname->fullname}} </td>
                                    <td>{{$avlist->day}}-{{$list->AvaliableCourse->time}}:00</td>
                                    <td>{{$avlist->location}}</td>
                                    <td>{{$totalRq}}</td>
                                    
                                </tr>

                            @endforeach
                        @endif
                    </tbody>
                </table> 
            </div>   