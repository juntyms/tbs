<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="mymodal-header">
            <div class="row">
                <div class="col-11">
                    <h5 class="modal-title" id="exampleModalLabel">session already booked !!</h5>
                </div>
                <div  class="col-1 f-right" >
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
                                        <div class="d-flex flex-column"> <span class="heading d-block">Course</span> <span class="subheadings">{{$is_booked->AvaliableCourse->course->name}}</span> </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column"> <span class="heading d-block">Time/Date</span> <span class="subheadings">{{$is_booked->AvaliableCourse->day}},{{$is_booked->AvaliableCourse->time}}:00</span> </div>
                                    </td>
                                
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex flex-column"> <span class="heading d-block">Department</span> <span class="subheadings">{{$dep->name}}</span> </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column"> <span class="heading d-block">Location</span> <span class="subheadings">{{$is_booked->AvaliableCourse->location}}</span> </div>
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
                        <div class="profile"> <img src="{{asset('/storage/images/'.$is_booked->AvaliableCourse->tutor->gettutorname->photo)}}" width="100" class="rounded-circle img-thumbnail"> <span class="d-block mt-3 font-weight-bold">{{$is_booked->AvaliableCourse->tutor->gettutorname->fullname}}</span> </div>
                        <div class="about-Tutor">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column"> <span class="heading d-block">Department</span> <span class="subheadings">{{$dep->name}}</span> </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column"> <span class="heading d-block">email</span> <span class="subheadings">{{$is_booked->AvaliableCourse->tutor->gettutorname->email}}</span> </div>
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
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>
