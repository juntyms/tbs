@extends('layouts.dashboard')
@section('title')
System roles
@endsection
@section('PageTitle')
    <h3>Role Management</h3>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/'.($page ='roles')) }}">Role</a></li>
        </ol>
      </nav>
@endsection
@section('content')
<div class="row">

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
              <h5 class="card-title">
                @can('role-create')
                    <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
                @endcan
              </h5>
              @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
              @endif
              <!-- Table with stripped rows -->
              <div class="table-responsive">
                <table class="table datatable table-hover">

                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
                                    @can('role-edit')
                                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                    @endcan
                                    @can('role-delete')
                                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                    {!! $roles->render() !!}
                </div>             
            </div>
        </div>
    </div>
</div>
@endsection

                                        