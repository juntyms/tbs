@extends('layouts.dashboard')
@section('title')
Profile
@endsection
@section('PageTitle')
    <h3>Profile </h3>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('user.profile')}}">profile</a></li>
        </ol>
      </nav>
    
@endsection

@section('content')


    <div class="row">
        <div class="col-xl-4">

            <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column">

                <img src="{{asset('/storage/images/'.Auth::user()->photo)}}" alt="Profile" class="rounded-circle h-50 w-50">
                <h5>{{$userpofile->fullname}}</h5>
               
                <div class="social-links mt-2 float-start">
                <a href="https://api.whatsapp.com/send/?phone=%2B{{Auth::user()->phone}}&amp;text&amp;app_absent=0" target="_blank" class="linkedin"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>
            </div>

        </div>

        <div class="col-xl-8">

            <div class="card">
            <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">
                   

                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                    </li>
                   
                    @can('edit-profile')
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                        </li>
                    @endcan

                </ul>
                <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                    <h5 class="card-title">About</h5>
                    <p class="small fst-italic">{{Auth::user()->about}}</p>

                    <h5 class="card-title">Profile Details</h5>

                    <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{$userpofile->fullname}}</div>
                    </div>

                    <div class="row">
                    <div class="col-lg-3 col-md-4 label">Department</div>
                    <div class="col-lg-9 col-md-8">{{$userpofile->department->name}}</div>
                    </div>

                    <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">{{$userpofile->phone}}</div>
                    </div>

                    <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{$userpofile->email}}</div>
                    </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                    <!-- Profile Edit Form -->
                    <form action="{{route('update.profile')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="row mb-3">
                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                            <div class="col-md-8 col-lg-9">
                            <img class="image rounded-circle" src="{{asset('/storage/images/'.Auth::user()->photo)}}" alt="profile_image" style="width: 50px;height: 50px; padding: 10px; margin: 0px; ">

                            <div class="pt-2">
                                <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                                <input type="file" name="photo">
                                
                            </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                            <div class="col-md-8 col-lg-9">
                            <textarea name="about" class="form-control" id="about" style="height: 100px">{{Auth::user()->about}}</textarea>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="phone" type="text" class="form-control" id="Phone" value={{Auth::user()->phone}}>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form><!-- End Profile Edit Form -->

                </div>


                </div><!-- End Bordered Tabs -->

            </div>
            </div>

        </div>
    </div>
@endsection