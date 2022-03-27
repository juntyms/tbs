<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
             
              <!-- Table with stripped rows -->
              <div class="table-responsive">
                <table class="table datatable table-hover">

                    <thead>
                    <tr>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th></th>
                       
                    </tr>
                    </thead>
                    <tbody>
                            @foreach($Dep_AVCourses as $av)
                                <tr>
                                    <td>{{$av->code }}</td>
                                    <td>{{$av->name }} </td>
                                    <td><a href="{{route('AvlisTu',['depid'=>$dep->id,'course'=>$av->id])}}" style="color:black"><i class="bi bi-search">Preview</i></a>
                                    </td>
                                </tr>

                            @endforeach
                    </tbody>
                </table> 
              </div>             
            </div>
        </div>
    </div>
</div>


               
