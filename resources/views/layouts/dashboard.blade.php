<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="" name="description">
  <meta content="" name="keywords">
  <meta name="csrf-token" content="{{ csrf_token() }}">

@livewireStyles
@include('layouts.head')
</head>

<body>
    @livewireScripts
    @include('sweetalert::alert')
    @include('layouts.main-header')
    @include('layouts.main-sidebar.admin-main-sidebar')
    
    
    <main id="main" class="main">

        @yield('PageTitle')
        <section class="section">
            @yield('content')
        </section>
    
    </main>
    @include('layouts.footer')

<!--=================================
footer -->

@include('layouts.footer-scripts')
@yield('customjs')

</body>

</html>
