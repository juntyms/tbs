
@extends('layouts.dashboard')
@section('title')
users
@endsection
@section('PageTitle')
    <h3>Users Management </h3>
      <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
        </ol>
      </nav>
   
@endsection

@section('content')
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
           <h5 class="card-title">
              @can('user-create')
                <div class="col-lg-12 mb-3">
                
                  <div class="text-left">
                      <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
                  </div>
                </div>
              @endcan
            </h5>
            @if ($message = Session::get('success'))
              <div class="alert alert-success">
                <p>{{ $message }}</p>
              </div>
            @endif


            <div class="table-responsive">
              <table class="table datatable table-hover">
                <thead>

                  <tr>
                    <th>No</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Full Name</th>
                    <th>Department</th>
                    <th>Roles</th>
                    <th width="300px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $key => $user)
                    <tr>
                      <td>{{ ++$i }}</td>
                      <td>{{ $user->username }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{$user->fullname}}</td>
                      <td>{{$user->department->name}}</td>
                      <td>
                        @if(!empty($user->getRoleNames()))
                          @foreach($user->getRoleNames() as $v)
                            <label  >{{ $v }}</label>
                          @endforeach
                        @endif
                      </td>
                      <td>
                        <a class="btn btn-info btn-sm mb-2" href="{{ route('users.show',$user->id) }}">Show</a>
                        @can('user-edit')
                        <a class="btn btn-sm btn-primary mb-2" href="{{ route('users.edit',$user->id) }}">Edit</a>
                        @endcan
                        @can('user-delete')
                        <a class="btn btn-sm btn-success mb-2" href="{{ route('users.destroy',$user->id) }}"> Delete</a>
                        @endcan
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
@endsection