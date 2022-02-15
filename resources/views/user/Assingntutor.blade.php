<div class="modal-dialog" role="document">
    {{ Form::open(['route'=>['user.Assingtutor',$Dep_user->id,$Dep_user->department_id]]) }}
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Add Tutor</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <div class="card card-body mt-2">
                        <div class="form-floating mb-3 mt-3">
                            {{ Form::text('username',$Dep_user->username,['class' => 'form-control','placeholder' => 'username','readonly']) }}
                            {{ Form::label('username') }}
                        </div>
                        <div class="form-floating mb-3">
                            {{ Form::text('name',$Dep_user->fullname,['class' => 'form-control','placeholder' => 'user Name','readonly']) }}
                            {{ Form::label('Full Name') }}
                            
                        </div>
                        
                            <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0"style='color:green;font-weight:bold;'>User Type</legend>
                                    <div class="col-sm-10">
                                        
                                        <div class="form-check">
                                            {{ Form::label('Stuff',null,['class'=>'form-check-label ']) }}
                                            {{ Form::radio('usertype',1,['class'=>'form-check-input','checked'])}}
                                        
                                        </div>

                                        <div class="form-check">
                                            {{ Form::label('Student',null,['class'=>'form-check-label']) }}
                                            {{ Form::radio('usertype',2,['class'=>'form-check-input','checked'])}}
                                        
                                        </div>

                                    </div>
                        
                            </fieldset>
                     
                </div>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">close</button>
                <button type="submit"
                    class="btn btn-success">sumbit</button>
                
            </div>
        </div>
    {{ Form::close() }}
</div>