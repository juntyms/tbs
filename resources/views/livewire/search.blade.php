<div class="col-lg-12">
    <div class="card">
        <div class="card-body">       
            <div class="row">
                <div class="col-lg-12 m-5">
                    <form id="search-form" wire:submit.prevent="submit()">
                        <div class="row">
                            <div class="col-7">
                                <p class="text-center">The Academic Year <strong>{{$A}}</strong>  - Sememster <strong>{{$S}}</strong> </p>
                            </div>
                            <div class="col-12 text-center">
                                <div class="row no-gutters">
                                    <div class="row no-gutters m-3 mx-5">
                                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                                {{ Form::select('selectA',$years,null,['class' => 'form-select', 'id'=>'selectA','wire:model'=>'selectA', 'placeholder' => 'Select Academic Year']) }}
                                            
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                            {{ Form::select('selectS',$semesters,null,['class' => 'form-select', 'id'=>'selectS','wire:model'=>'selectS', 'placeholder' => 'Select Semester']) }}
                                            
                                        </div>
                                    </div>
                                    <div class="row no-gutters">
                                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                            {{ Form::select('selectST',$Students,null,['class' => 'form-select', 'id'=>'selectST','wire:model'=>'selectST', 'placeholder' => 'Select Student']) }}
                                            
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                            {{ Form::select('selectT',$tutors,null,['class' => 'form-select', 'id'=>'selectT','wire:model'=>'selectT', 'placeholder' => 'Select Tutor']) }}
                                            
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                            {{ Form::select('selectC',$avaiablesC,null,['class' => 'form-select', 'id'=>'selectC','wire:model'=>'selectC', 'placeholder' => 'Select course']) }}
                                        
                                        </div>
                                        <div class="col-lg-1 col-md-3 col-sm-12 p-0">
                                            <button type="submit" class="btn btn-base btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                    
                                    
                               
                                
                            </div>
                        </div>
                    </form>     
                </div>
            </div>

            @if($Tpage)
            @include('livewire.search.tutor')

            @elseif($Spage)
            @include('livewire.search.student')

            @endif


                     
        </div>
    </div>
</div>

