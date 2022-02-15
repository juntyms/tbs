<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.html">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      @can('TBS-managment')
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#TBS_Main" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>TBS system managment</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="TBS_Main" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            @can('acadmicyear-list')
              <li>
                <a href="{{route('AcadmicY.index')}}">
                  <i class="bi bi-circle"></i><span>Acadmic years</span>
                </a>
              </li>
            @endcan
            @can('user-list')
              <li>
                <a href="{{ url('/'.($page ='users')) }}">
                  <i class="bi bi-circle"></i><span>users</span>
                </a>
              </li>
            @endcan
            @can('role-list')
              <li>
                <a href="{{ url('/'.($page ='roles')) }}">
                  <i class="bi bi-circle"></i><span>roles</span>
                </a>
              </li>
            @endcan
            
            
          </ul>
        </li><!-- TBS system managment -->
      @endcan
      @can('dep-list')
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#Dep" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Department</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="Dep" class="nav-content collapse " data-bs-parent="#sidebar-nav2">
           @can('dep-user')
              <li>
                <a href="{{route('user.index')}}">
                  <i class="bi bi-circle"></i><span>users</span>
                </a>
              </li>
            @endcan
            @can('dep-course')
              <li>
                <a href="{{route('course.index')}}">
                  <i class="bi bi-circle"></i><span>courses</span>
                </a>
              </li>
            @endcan
          </ul>
        </li><!-- End Components Nav -->
      @endcan
      @can('dep-TBS')

        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#Dep_TBS" data-bs-toggle="collapse"  href="#">
            <i class="bi bi-journal-text"></i><span>Department TBS</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="Dep_TBS" class="nav-content collapse" data-bs-parent="#sidebar-nav3">
            @can('dep-tutor-list')
              <li>
                <a href="{{route('user.tutor')}}" class="active">
                  <i class="bi bi-circle"></i><span>Tutor</span>
                </a>
              </li>
            @endcan
            @can('dep-AVcourse-list')
              <li>
                <a href="{{route('Acourse.index')}}">
                  <i class="bi bi-circle"></i><span>Avaliable courses</span>
                </a>
              </li>
            @endcan
          </ul>
        </li><!-- End Forms Nav -->
      @endcan
      @can('booking')
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('student.booking.Department')}}">
          <i class="bi bi-card-list"></i>
          <span>Booking</span>
        </a>
      </li><!-- End Profile Page Nav -->
      @endcan
      @can('student-schedule')
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('student.tutorial.timetable')}}">
          <i class="bi bi-card-list"></i>
          <span>student timetable</span>
        </a>
      </li><!-- End Register Page Nav -->
      @endcan
      @can('student-tutorials')

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('student.tutorial.list')}}">
          <i class="bi bi-card-list"></i>
          <span>current tutorials</span>
        </a>
      </li><!-- End Register Page Nav -->
      @endcan
      @can('student-tutorials')
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('student.tutorial.alllist')}}">
          <i class="bi bi-card-list"></i>
          <span>All tutorials</span>
        </a>
      </li><!-- End Register Page Nav -->
      @endcan
      @can('tutor-tutorials')
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('Tutor.tutorial.timetable')}}">
          <i class="bi bi-card-list"></i>
          <span>tutor timetable</span>
        </a>
      </li><!-- End Register Page Nav -->
      @endcan
      @can('tutor-tutorials')
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('Tutor.tutorial.list')}}">
          <i class="bi bi-card-list"></i>
          <span>current Requests </span>
        </a>
      </li><!-- End Register Page Nav -->
      @endcan
      @can('tutor-tutorials')
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('Tutor.tutorial.allRequest')}}">
          <i class="bi bi-card-list"></i>
          <span>All Requests</span>
        </a>
      </li><!-- End Register Page Nav -->
      @endcan

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('user.profile')}}">
          <i class="bi bi-person"></i>
          <span>profile</span>
        </a>
      </li><!-- End Login Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->
