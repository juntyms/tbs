<div class="modal-dialog" role="document">
    
    <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">Add Aavaliable Course</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            {{ Form::open(['route'=>['Addcourse.added',$tutorid->id]]) }}
                <div class="panel-body">
                    <div class="card card-body">

                        <div class="form-floating mb-3">
                            {{ Form::text('day',$wdays[$x],['class' => 'form-control','placeholder' => 'Selected Day','readonly']) }}
                            {{ Form::label('Day') }}
                            @error('day')
                                <div class="text-danger mt-2 text-sm">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            {{ Form::text('time',$Ttimes[$i],['class' => 'form-control','placeholder' => 'Selected time','readonly']) }}
                            {{ Form::label('Time') }}
                            @error('time')
                                <div class="text-danger mt-2 text-sm">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            {{ Form::select('course',$DepC,null,['class' => 'form-control','placeholder' => 'Selected course']) }}
                            {{ Form::label('course') }}
                            @error('course')
                                <div class="text-danger mt-2 text-sm">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            {{ Form::text('location',null,['class' => 'form-control','placeholder' => 'Enter Location']) }}
                            {{ Form::label('Location') }}
                            @error('day')
                                <div class="text-danger mt-2 text-sm">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            {{ Form::text('link',null,['class' => 'form-control','placeholder' => 'Enter Location']) }}
                            {{ Form::label('Link') }}
                            @error('day')
                                <div class="text-danger mt-2 text-sm">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                        
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>