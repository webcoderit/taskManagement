<div class="sidebar-wrapper" data-simplebar="true">
  <div class="sidebar-header">
    <div>
        <img src="{{ asset('backend/') }}/logo.jpg" class="" alt="logo icon" style="width: 206px; height: 58px">
    </div>
  </div>
  <!--navigation-->
  <ul class="metismenu" id="menu">
    <li>
      <a href="{{ url('/admin/dashboard') }}" class="has-arrow">
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
        <li> <a href="{{ route('admin.user.register.form.create') }}"><i class="bx bx-right-arrow-alt"></i>Add user</a></li>
        <li> <a href="{{ route('admin.user.list') }}"><i class="bx bx-right-arrow-alt"></i>Registration User</a></li>
{{--        <li> <a href="{{ route('admin.user.online') }}"><i class="bx bx-right-arrow-alt"></i>Employee Tracking</a></li>--}}
{{--        <li> <a href="{{ route('admin.user.attendance.log') }}"><i class="bx bx-right-arrow-alt"></i>Attendance report</a></li>--}}
        <li> <a href="{{ route('admin.user.call.summery') }}"><i class="bx bx-right-arrow-alt"></i>Employee Summery</a></li>
        <li> <a href="{{ url('/admin/batch/create') }}"><i class="bx bx-right-arrow-alt"></i>Add batch</a></li>
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
        <li> <a href="{{ route('admin.task.summery') }}"><i class="bx bx-right-arrow-alt"></i>Task Summary</a></li>
        <li> <a href="{{ route('admin.pending.task') }}"><i class="bx bx-right-arrow-alt"></i>Pending task</a>
        </li>
        <li> <a href="{{ route('admin.complete.admission') }}"><i class="bx bx-right-arrow-alt"></i>Complete admission</a>
        </li>
        <li> <a href="{{ route('admin.highly.interested') }}"><i class="bx bx-right-arrow-alt"></i>Highly interested</a></li>
        <li> <a href="{{ route('admin.interested') }}"><i class="bx bx-right-arrow-alt"></i>50% Interested</a></li>
        <li> <a href="{{ route('admin.not.interested') }}"><i class="bx bx-right-arrow-alt"></i>Not interested</a></li>

        <li> <a href="{{ route('admin.recall') }}"><i class="bx bx-right-arrow-alt"></i>Others</a></li>
      </ul>
    </li>
      <li>
          <a class="has-arrow" href="javascript:;">
              <div class="parent-icon"><i class='bx bx-bookmark-heart'></i></div>
              <div class="menu-title">Accounts</div>
          </a>
          <ul>
              <li> <a href="{{ url('/admin/user/expanse/list') }}"><i class="bx bx-right-arrow-alt"></i>Expanse</a></li>
              <li> <a href="{{ url('/admin/user/due/report') }}"><i class="bx bx-right-arrow-alt"></i>Due Collect Report</a></li>
          </ul>
      </li>
      <li>
          <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><i class='bx bx-user'></i>
              </div>
              <div class="menu-title">Students</div>
          </a>
          <ul>
              <li> <a href="{{ url('/admin/students/list') }}"><i class="bx bx-right-arrow-alt"></i>Student list</a></li>
              <li> <a href="{{ url('admin/user/admission/filtering') }}"><i class="bx bx-right-arrow-alt"></i>Student Count</a></li>
              <li>
                  <a href="{{ route('admin.filtering') }}">
                      <i class="bx bx-right-arrow-alt"></i>
                      Task Filtering
                  </a>
              </li>
          </ul>
      </li>
  </ul>
  <!--end navigation-->
</div>
