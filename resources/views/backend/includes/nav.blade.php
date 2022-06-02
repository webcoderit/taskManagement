<div class="sidebar-wrapper" data-simplebar="true">
  <div class="sidebar-header">
    <div>
      <img src="{{ asset('backend/') }}/logo.jpg" class="" alt="logo icon" style="width: 206px; height: 58px">
    </div>
{{--    <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i></div>--}}
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
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
        </div>
        <div class="menu-title">Tasks</div>
      </a>
      <ul>
        <li> <a href="{{ url('/today/task') }}"><i class="bx bx-right-arrow-alt"></i>Today Task</a></li>
        <li> <a href="{{ url('/all/task') }}"><i class="bx bx-right-arrow-alt"></i>All task</a></li>
        <li> <a href="{{ url('/pending/task') }}"><i class="bx bx-right-arrow-alt"></i>Pending task</a></li>
        <li> <a href="{{ url('/confirm/addmission') }}"><i class="bx bx-right-arrow-alt"></i>Confirm admission</a></li>
        <li> <a href="{{ url('/addmission/form') }}"><i class="bx bx-right-arrow-alt"></i>Admission Form</a></li>
        <li> <a href="{{ url('/highly/interested') }}"><i class="bx bx-right-arrow-alt"></i>Highly interested</a></li>
        <li> <a href="{{ url('/interested') }}"><i class="bx bx-right-arrow-alt"></i>50%  Interested</a></li>
        <li> <a href="{{ url('/not/interested') }}"><i class="bx bx-right-arrow-alt"></i>Not interested</a></li>
        <li> <a href="{{ url('/others') }}"><i class="bx bx-right-arrow-alt"></i>Others</a></li>
        <li> <a href="{{ url('/money/receipt') }}"><i class="bx bx-right-arrow-alt"></i>Money Receipt</a></li>
      </ul>
    </li>
    <li>
        <a class="has-arrow" href="{{ url('/chat') }}">
          <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
          </div>
          <div class="menu-title">Community</div>
        </a>
      </li>
  </ul>
  <!--end navigation-->
</div>
