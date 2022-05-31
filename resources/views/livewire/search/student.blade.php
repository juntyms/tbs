<div class="table-responsive">
                <table class="table datatable table-hover">

                    <thead>
                    <tr>
                        <th>Tutorial ID</th>
                        <th>Course</th>
                        <th>Tutor Name</th>
                        <th>Date</th>
                        <th>Day/Time</th>
                        <th>Location</th>
                        <th>Status</th>
                       
                    </tr>
                    </thead>
                    <tbody>
                            @foreach($listTutorial as $list)
                                <tr>
                                    <td>{{$list->id}}</td>
                                    <td>{{$list->AvaliableCourse->course->name}}</td>
                                    <td>{{$list->AvaliableCourse->tutor->gettutorname->fullname}} </td>
                                    <td>{{$list->date}}</td>
                                    <td>{{$list->AvaliableCourse->day}}-{{$list->AvaliableCourse->time}}:00</td>
                                    <td>{{$list->AvaliableCourse->location}}</td>
                                    @if($list->accepted==0)
                                      <td>Waiting Approval</td>
                                    @elseif($list->accepted==1)
                                      <td>Approved</td>
                                      @elseif($list->accepted==2)
                                      <td>Rejected</td>
                                      @elseif($list->accepted==3)
                                        <td>Completed</td>
                                      @elseif($list->accepted==4)
                                        <td>Incomplete</td>
                                    @endif
                                </tr>

                            @endforeach
                    </tbody>
                    </table> 
                </div>      