@extends('layouts.dashboard')
@section('title')
Department tutors
@endsection
@section('PageTitle')
    <h3>Department Tutor</h3>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('user.tutor')}}">Department Tutor</a></li>
        </ol>
      </nav>
  
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                @can('dep-user')
                    <h5 class="card-title">
                    <a href="{{route('user.index')}}" class="btn btn-success btn-sm" role="button" aria-pressed="true">
                        Add Tutor
                    </a>
                    @if ($message = Session::get('success'))
                           
                                <div class="alert alert-success">
                                    <p>{{ $message}}</p>
                                </div>
                            
                        @endif
                        @if ($message = Session::get('error'))
                           
                            <div class="alert alert-danger">
                                <p>{{ $message }}</p>
                            </div>
                           
                        @endif
                    </h5>
                @endcan
                <!-- Table with stripped rows -->
                <div class="table-responsive">
                    <table class="table datatable table-hover">
                        <thead>
                            <tr>
                                <th>Tutor Name</th>
                                <th>Department</th>
                                <th>Type</th>
                                <th>Create At</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Dep_tutors as $Dep_tutor)
                                <tr>
                                    <td>{{ $Dep_tutor->gettutorname->fullname }} </td>
                                    <td>{{ $Dep_tutor->gettutorname->department->name }} </td>
                                    
                                    @if($Dep_tutor->is_staff==1)
                                   
                                        <td>Staff </td>
                                    @else
                                        <td>Student</td>
                                    @endif
                                    <td>{{ $Dep_tutor->created_at }} </td>
                                    
                                    <td>
                                        @can('dep-tutor-delete',)
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deletetutor{{$Dep_tutor->id}}">
                                            <i class="fa fa-trash">Delete tutor</i>
                                        </button>
                                        <!-- Modal update -->
                                        <div class="modal fade" id="deletetutor{{$Dep_tutor->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            @include('user.TutorDelete')
                                        </div>
                                        @endcan
                                    
                                        @can('dep-AVcourse-add')
                                        <form class="btn"  action="{{route('Addcourse.index')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="livesearch" value="{{$Dep_tutor->gettutorname->id}}">
                                            <button  type="submit"class="btn btn-sm btn-primary">view</button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection