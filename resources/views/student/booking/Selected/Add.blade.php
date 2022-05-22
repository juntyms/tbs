<div class="modal-dialog modal-lg">
  {{ Form::open(['route'=>['student.booking.create',['avaliablecourse'=>$ct->id,'tutorid'=>$ct->tutor_id]]]) }}
    <div class="modal-content">
        <div class="mymodal-header">
            <div class="row">
                <div class="col-11">
                    <h5 class="modal-title" id="exampleModalLabel">Booking Tutorial Confirmation</h5>
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
                                        <div class="d-flex flex-column"> <span class="heading d-block">Course</span> <span class="subheadings">{{$ct->course->name}}</span> </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column"> <span class="heading d-block">Time/Date</span> <span class="subheadings">{{$ct->day}},{{$ct->time}}:00</span> </div>
                                    </td>
                                
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex flex-column"> <span class="heading d-block">Department</span> <span class="subheadings">{{$dep->name}}</span> </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column"> <span class="heading d-block">Location</span> <span class="subheadings">{{$ct->location}}</span> </div>
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
                        <div class="profile"> <img src="{{asset('/storage/images/'.$ct->tutor->gettutorname->photo)}}" width="100" class="rounded-circle img-thumbnail"> <span class="d-block mt-3 font-weight-bold">{{$ct->tutor->gettutorname->fullname}}</span> </div>
                        <div class="about-Tutor">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column"> <span class="heading d-block">Department</span> <span class="subheadings">{{$dep->name}}</span> </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column"> <span class="heading d-block">email</span> <span class="subheadings">{{$ct->tutor->gettutorname->email}}</span> </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row mb-3">
                        <label for="comment" class="heading">comment</label>
                        <div class="col-md-8 col-lg-9">
                        {{ Form::textarea('comment',null,['class' => 'form-control subheadings','style'=>'height: 100px','placeholder' => 'type your request','required']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
        
            <button type="submit" class="btn btn-success"><i class="fa fa-trash">Submit</i></button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
  {{ Form::close() }}
</div>
