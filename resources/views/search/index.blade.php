@extends('layouts.dashboard')
@section('title')
Search
@endsection
@section('cutomcss')

@endsection
@section('PageTitle')
    <h3> Search</h3>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('search')}}">Search</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
@endsection
@section('content')
<div class="row">
  @livewire('search')
</div>
@endsection