<div class="sidebar-wrapper" data-simplebar="true">
  <div class="sidebar-header">
    <div>
      <img src="{{ asset('backend/') }}/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
    </div>
    <div>
      <h4 class="logo-text">Webcoder-IT</h4>
    </div>
    <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
    </div>
  </div>
  <!--navigation-->
  <ul class="metismenu" id="menu">
    <li>
      <a href="{{ url('/employee/dashboard') }}" class="has-arrow">
        <div class="parent-icon"><i class='bx bx-home-circle'></i>
        </div>
        <div class="menu-title">Dashboard</div>
      </a>
    </li>
    <li>
    <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
        </div>
        <div class="menu-title">Tasks</div>
      </a>
      <ul>
        <li> <a href="{{ url('/today/task') }}"><i class="bx bx-right-arrow-alt"></i>Today Task</a></li>
        <li> <a href="#"><i class="bx bx-right-arrow-alt"></i>All task</a></li>
      </ul>
    </li>
  </ul>
  <!--end navigation-->
</div>
