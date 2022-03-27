@extends('layouts.dashboard')
@section('title')
Department users
@endsection
@section('PageTitle')
    <h3>Department users</h3>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('user.index')}}">Department Users</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
@endsection
@section('content')
<div class="row">

    <div class="col-lg-12">

        <div class="card">
            @if ( $message = Session::get('error'))
                <h5 class="card-title">
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                </h5>
            @endif
            @if ($message = Session::get('success'))
                <h5 class="card-title">
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                </h5>
            @endif
            <div class="card-body">
              <!-- Table with stripped rows -->
              <div class="table-responsive">
                <table class="table datatable table-hover">

                    <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Created_at</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                            @foreach($Dep_users as $Dep_user)
                                <tr>
                                    <td>{{$Dep_user->username }}</td>
                                    <td>{{$Dep_user->fullname }}</td>
                                    <td>{{$Dep_user->email }} </td>
                                    <td>{{Auth::User()->department->name}}</td>
                                    <td>{{$Dep_user->created_at}}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#user_AssignTutor{{$Dep_user->id}}" title="Assign"><i class="ri-add-circle-fill"></i></button>
                                    </td>
                               

                                    <div class="modal fade" id="user_AssignTutor{{$Dep_user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    @include('user.Assingntutor')
                                    </div>
                                </tr>
                            @endforeach
                    </tbody>
                    </table> 
                </div>             
            </div>
        </div>
    </div>
</div>
@endsection

                                        