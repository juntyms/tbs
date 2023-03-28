<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="mymodal-header">
            <div class="row">
                <div class="col-11">
                    <h5 class="modal-title ps-3" id="exampleModalLabel">Tutorial Status</h5>
                </div>
                <div class="col-1 f-right">
                    <button type="button" class="close f-right" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="mymodal-body">
            <div class="row g-0">
                <div class="col-md-8 border-right">
                    <div class="status p-3">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex flex-column"> <span class="heading d-block">Course</span>
                                            <span class="subheadings">{{$list->AvaliableCourse->course->name}}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column"> <span class="heading d-block">Time/Date</span>
                                            <span
                                                class="subheadings">{{$list->AvaliableCourse->day}},{{$list->AvaliableCourse->time}}:00</span>
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex flex-column"> <span class="heading d-block">Department</span>
                                            <span
                                                class="subheadings">{{$list->AvaliableCourse->course->departmentname->name}}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column"> <span class="heading d-block">Location</span>
                                            <span class="subheadings">{{$list->AvaliableCourse->location}}</span>
                                        </div>
                                    </td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-2 text-center">
                        <div class="profile"> <img src="{{URL::asset('assets/img/user_icon.png')}}" width="100"
                                class="rounded-circle img-thumbnail"> <span
                                class="d-block mt-3 font-weight-bold">{{$list->student->fullname}}</span> </div>
                        <div class="about-Tutor">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column"> <span
                                                    class="heading d-block">Department</span> <span
                                                    class="subheadings">{{$list->student->department->name}}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column"> <span class="heading d-block">Email</span>
                                                <span class="subheadings">{{$list->student->email}}</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            @if(@$list->accepted==0)

            <a href="{{route('Tutor.tutorial.status',['id'=>$list->id,'status'=>1])}}">
                <button type="button" class="btn btn-success"><i class="fa fa-trash">Approve</i></button>
            </a>
            <a href="{{route('Tutor.tutorial.status',['id'=>$list->id,'status'=>2])}}">
                <button type="button" class="btn btn-success"><i class="fa fa-trash">Reject</i></button>
            </a>
            @elseif($list->accepted==1)
            <a href="{{route('Tutor.tutorial.status',['id'=>$list->id,'status'=>3])}}">
                <button type="button" class="btn btn-success"><i class="fa fa-trash">Completed</i></button>
            </a>
            <a href="{{route('Tutor.tutorial.status',['id'=>$list->id,'status'=>4])}}">
                <button type="button" class="btn btn-success"><i class="fa fa-trash">Incomplete</i></button>
            </a>

            @elseif($list->accepted==4 || $list->accepted==2)
            <a href="{{route('Tutor.tutorial.status',['id'=>$list->id,'status'=>3])}}">
                <button type="button" class="btn btn-success"><i class="fa fa-trash">Completed</i></button>
            </a>


            @endif
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
    </div>