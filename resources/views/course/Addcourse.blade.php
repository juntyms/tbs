<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">Add New Course</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            {{ Form::open(['route'=>'course.save']) }}
            <div class="panel-body">
                <div class="card card-body">
                    <div class="form-floating mb-3">
                        {{ Form::text('courscode',null,['class' => 'form-control','placeholder' => 'course Code']) }}
                        {{ Form::label('Course Code') }}
                        @error('courscode')
                        <div class="text-danger mt-2 text-sm">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        {{ Form::text('name',null,['class' => 'form-control','placeholder' => 'Course Name']) }}
                        {{ Form::label('Course Name') }}
                        @error('name')
                        <div class="text-danger mt-2 text-sm">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success"> Submit</button>

            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>