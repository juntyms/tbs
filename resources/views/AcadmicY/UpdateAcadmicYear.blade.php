<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">Update Academic Year</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            {{ Form::open(['route'=>['AcadmicY.updateADyear',$AD_year->id]]) }}
            <div class="panel-body">
                <div class="card card-body">
                    <div class="form-floating mb-3">
                        {{ Form::text('id',$AD_year->id,['class' => 'form-control','placeholder' => 'ID','readonly']) }}
                        {{ Form::label('ID') }}
                    </div>
                    <div class="form-floating mb-3">
                        {{ Form::text('name',$AD_year->name,['class' => 'form-control','placeholder' => 'Academic Year']) }}
                        {{ Form::label('Academic Year') }}
                        
                    </div>
                    <div class="form-floating mb-3">
                            {{ Form::text('semester',$AD_year->semester,['class' => 'form-control','placeholder' => 'semester']) }}
                            {{ Form::label('semester') }}
                    </div>
                    <div class="form-group col col-lg-6">
                        <label for="rtypes" class="">Activate</label>                                          
                        <div class="form-check">
                            @if($AD_year->is_active==1)
                                {{ Form::label(' Activate ') }}
                                {{ Form::radio('status',1,['class'=>'form-check-input',])}}
                            @else
                            {{ Form::label(' Activate ') }}
                            {{ Form::radio('status',1)}}
                            @endif
                        </div>

                        <div class="form-check">
                            @if($AD_year->is_active !==1)
                                {{ Form::label(' Deactivate ') }}
                                {{ Form::radio('status',0,['class'=>'form-check-input',])}}
                            @else
                                {{ Form::label(' Deactivate ') }}
                                {{ Form::radio('status',0)}}
                            @endif
                           
                        </div>

                    </div>
                </div>
            
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button>
                    <button type="submit" class="btn btn-success">update</button>
                    
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>