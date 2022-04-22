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
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class='bx bx-user'></i>
        </div>
        <div class="menu-title">Users</div>
      </a>
      <ul>
        <li> <a href="{{ route('admin.user.list') }}"><i class="bx bx-right-arrow-alt"></i>Registration</a></li>
        <li> <a href="{{ route('admin.user.register.form.create') }}"><i class="bx bx-right-arrow-alt"></i>Add user</a></li>
        <li> <a href="{{ route('admin.user.online') }}"><i class="bx bx-right-arrow-alt"></i>Employee Tracking</a></li>
      </ul>
    </li>
    <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
        </div>
        <div class="menu-title">Tasks</div>
      </a>
      <ul>
        <li> <a href="{{ route('admin.add.task') }}"><i class="bx bx-right-arrow-alt"></i>Add task</a>
        </li>
        <li> <a href="{{ route('admin.list.task') }}"><i class="bx bx-right-arrow-alt"></i>Today Task</a>
        </li>
        <li> <a href="{{ route('admin.all.task') }}"><i class="bx bx-right-arrow-alt"></i>All task</a>
        </li>
        <li> <a href="{{ route('admin.complete.task') }}"><i class="bx bx-right-arrow-alt"></i>Complete task</a>
        </li>
        <li> <a href="{{ route('admin.pending.task') }}"><i class="bx bx-right-arrow-alt"></i>Pending task</a>
        </li>
        <li> <a href="{{ route('admin.confirm.admission') }}"><i class="bx bx-right-arrow-alt"></i>Confirm admission</a>
        </li>
        <li> <a href="{{ route('admin.not.interested') }}"><i class="bx bx-right-arrow-alt"></i>Not interested</a>
        </li>
        <li> <a href="{{ route('admin.highly.interested') }}"><i class="bx bx-right-arrow-alt"></i>Highly interested</a>
        </li>
        <li> <a href="{{ route('admin.interested') }}"><i class="bx bx-right-arrow-alt"></i>Interested</a>
        </li>
        <li> <a href="component-navs-tabs.html"><i class="bx bx-right-arrow-alt"></i>Recall</a>
        </li>
      </ul>
    </li>
  </ul>
  <!--end navigation-->
</div>
