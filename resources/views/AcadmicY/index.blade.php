@extends('layouts.dashboard')
@section('title')
Acadmic Year
@endsection
@section('PageTitle')
    <h1>Academic Years</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('AcadmicY.index')}}">Academic Years</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
@endsection
@section('content')
<div class="row">

    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
              <h5 class="card-title">
              <a href="#" class="btn btn-success btn-sm" role="button" aria-pressed="true"
              data-bs-toggle="modal" data-bs-target="#Addmodal">
                  Add Academic Year
                </a>
              </h5>
              <div class="modal fade" id="Addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  @include('AcadmicY.addAcadmicYear')
              </div>
              <!-- Table with stripped rows -->
              <div class="table-responsive">
                <table class="table datatable table-hover">

                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Acadmic Year</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                            @foreach($AD_years as $AD_year)
                                <tr>
                                    <td>{{$AD_year->id }}</td>
                                    <td>{{$AD_year->name }}</td>
                                    @if($AD_year->is_active==1)
                                        <td>Activated</td>
                                    @else
                                        <td>deactivated</td>
                                    @endif
                                    <td>{{$AD_year->created_at}}</td>
                                    <td>
                                        
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal{{$AD_year->id}}" title="Edit Acadmic year"><i class="bi bi-info-circle"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#DeleteModal{{$AD_year->id}}" title="Delete Acadmic year"><i class="bi bi-exclamation-triangle"></i></button>
                                        <!-- Modal update -->
                                        <div class="modal fade" id="updateModal{{$AD_year->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            @include('AcadmicY.UpdateAcadmicYear')
                                        </div>
                                        <!-- Modal delete -->
                                        <div class="modal fade" id="DeleteModal{{$AD_year->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            @include('AcadmicY.DeleteAcadmicYear')
                                        </div>

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

                                        