<div class="modal-dialog" role="document">
    
    <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">Edit Course</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            {{ Form::open(['route'=>['course.update', $Dep_Course->id]]) }}
                <div class="panel-body">
                    <div class="card card-body">

                        <div class="form-floating mb-3">
                            {{ Form::text('coursecode',$Dep_Course->code,['class' => 'form-control','placeholder' => '$Dep_Course->code']) }}
                            {{ Form::label($Dep_Course->code) }}
                            @error('courscode')
                                <div class="text-danger mt-2 text-sm">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            {{ Form::text('name',$Dep_Course->name,['class' => 'form-control','placeholder' => '$Dep_Course->name']) }}
                            {{ Form::label($Dep_Course->name) }}
                            @error('name')
                                <div class="text-danger mt-2 text-sm">
                                    {{$message}}
                                </div>
                            @enderror
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