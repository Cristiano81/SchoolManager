<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="https://creative-tim.com/" class="simple-text logo-normal">
      {{ __('Creative Tim') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
        <li class="nav-item{{ $activePage == 'schoolyear' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('schoolyear.index') }}">
                <i class="material-icons">class</i>
                <p>{{ __('School Year') }}</p>
            </a>
        </li>
        <li class="nav-item{{ $activePage == 'classroom' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('classroom.index') }}">
                <i class="material-icons">account_balance</i>
                <p>{{ __('Classroom') }}</p>
            </a>
        </li>
        <li class="nav-item{{ $activePage == 'teacher' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('teacher.index') }}">
                <i class="material-icons">accessibility</i>
                <p>{{ __('Teacher') }}</p>
            </a>
        </li>
        <li class="nav-item{{ $activePage == 'student' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('student.index') }}">
                <i class="material-icons">face</i>
                <p>{{ __('Student') }}</p>
            </a>
        </li>
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('table') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Table List') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'typography' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('typography') }}">
          <i class="material-icons">library_books</i>
            <p>{{ __('Typography') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'icons' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('icons') }}">
          <i class="material-icons">bubble_chart</i>
          <p>{{ __('Icons') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'map' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('map') }}">
          <i class="material-icons">location_ons</i>
            <p>{{ __('Maps') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('notifications') }}">
          <i class="material-icons">notifications</i>
          <p>{{ __('Notifications') }}</p>
        </a>
      </li>

    </ul>
  </div>
</div>
