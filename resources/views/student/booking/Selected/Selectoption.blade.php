@extends('layouts.dashboard')
@section('title')
Booking Select Department
@endsection
@section('customcss')
<link href="{{asset('assets/css/tiles.css')}}" rel="stylesheet">

@endsection
@section('PageTitle')
<h3><strong>{{$dep->name}}</strong>:<span> Available Courses</span></h3>
<nav>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('student.booking.Department')}}">Booking</a></li>
  </ol>
</nav>

@endsection
@section('content')
<div class="row">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link {{$vshow1}}" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Tile View</button>
            <button class="nav-link {{$vshow2}}" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">List View</button>
            <button class="nav-link {{$vshow3}}" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Calendar View</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show {{$vshow1}}" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">@include('student.booking.tilesselect')</div>
        <div class="tab-pane fade show {{$vshow2}}" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">@include('student.booking.DepartmentAvailablecourses')</div>
        <div class="tab-pane fade show {{$vshow3}}" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">@livewire('calanderview',['depid'=>$dep->id])</div>
    </div>
</div>


@endsection