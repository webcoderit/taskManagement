<div class="sidebar-wrapper" data-simplebar="true">
  <div class="sidebar-header">
    <div>
        <img src="{{ asset('backend/') }}/logo.jpg" class="" alt="logo icon" style="width: 206px; height: 58px">
    </div>
  </div>
  <!--navigation-->
  <ul class="metismenu" id="menu">
    <li>
      <a href="{{ url('/admin/hr/dashboard') }}" class="has-arrow">
        <div class="parent-icon"><i class='bx bx-home-circle'></i>
        </div>
        <div class="menu-title">Dashboard</div>
      </a>
    </li>
    <li>
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class='bx bx-user'></i>
        </div>
        <div class="menu-title">Students</div>
      </a>
      <ul>
        <li> <a href="{{ url('admin/student/list') }}"><i class="bx bx-right-arrow-alt"></i>Student list</a></li>
      </ul>
    </li>
    <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
        </div>
        <div class="menu-title">Accounts</div>
      </a>
      <ul>
        <li> <a href="{{ url('admin/expanse') }}"><i class="bx bx-right-arrow-alt"></i>Expanse</a></li>
      </ul>
    </li>
  </ul>
  <!--end navigation-->
</div>
