
<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    Select Tutor/Course
                </h5>
                
                <div class="card-title">
                    
                <form wire:submit.prevent="submit({{ $dep->id }})">
                    <div class="row">
                        <div class="col-lg-7 mb-3">
                           
                            {{ Form::select('selectT',$Serchtutor,null,['class' => 'form-control','id'=>'selectT','wire:model'=>'selectT','placeholder' =>'Selected Tutor']) }}
        
                            <br><br>
                            {{ Form::select('selectC',$courses,null,['class' => 'form-control','wire:model'=>'selectC','placeholder' => 'Selected Course']) }}
                        </div>
                                    
                        <div class="col-lg-5 mt-3">
                            <button class="btn btn-primary" type="submit" style="height:30px; width:100px;">Select</button>
                        </div>
                    </div>
                </form>
               
                    
                        
                    
                </div>
                @if($show1)
                    @include('livewire.Selected.course')

                @elseif($show2)
                    @include('livewire.Selected.tutor')

                @elseif($show3)
                    @include('livewire.Selected.CourseTutor')

                @endif
                <!-- Table with stripped rows -->
            </div> 
        </div>
    </div>
</div>    

 


