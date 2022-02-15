<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">Add Acadmic year </h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            {{ Form::open(['route'=>'AcadmicY.addADyear']) }}
                <div class="panel-body">
                
                    <div class="card card-body">
                        <div class="form-floating mb-3">
                            {{ Form::text('yearname',null,['class' => 'form-control','placeholder' => 'Acadmic year',]) }}
                            {{ Form::label('Acadmic year') }}
                        </div>
                        
                        <div class="form-group col col-lg-6">
                            <label for="rtypes" class="">Activate:</label>                                          
                            <div class="form-check">
                                {{ Form::label(' Activate:') }}
                                {{ Form::radio('status',1,['class'=>'form-check-input','checked'])}}
                                
                            </div>

                            <div class="form-check">
                                {{ Form::label('Deactivate:') }}
                                {{ Form::radio('status',2,['class'=>'form-check-input'])}}
                                
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button>
                    <button type="submit" class="btn btn-success">sumbit</button>
                    
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>