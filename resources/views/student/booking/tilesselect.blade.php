<div class="container bootstrap snippets bootdey">
    @php($x=0)
    <div class="row">
            @foreach($Dep_AVCourses as $av)
                @if($x==3)
                        
                    </div>
                    <div class="row">
                    @php($x=0)
                @endif

                @php($x++)
            
                        
              
                    <div class="col-sm-4">
                        
                        <div class="tile" style="background-color:#084C61;">
                            <h3 class="title text-white">{{$av->code }}</h3>
                            <p class="text-white">{{$av->name}}</p>
                            <a class="btnclick" style="background-color:#177E89;" href="{{route('AvlisTu',['depid'=>$dep->id,'course'=>$av->id])}}">Click</a>
                        </div>
                    </div>
             

            @endforeach
    </div>  
</div>                    
