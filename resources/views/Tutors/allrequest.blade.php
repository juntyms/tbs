@extends('layouts.dashboard')
@section('title')
All requests
@endsection
@section('cutomcss')

@endsection
@section('PageTitle')
    <h3> All Requested Tutorials</h3>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('Tutor.tutorial.allRequest')}}">All Requests</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
@endsection
@section('content')
<div class="row">
  @livewire('history')
</div>
@endsection


                                        