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
        <li> <a href="{{ route('admin.user.list') }}"><i class="bx bx-right-arrow-alt"></i>Registration</a></li>
        <li> <a href="{{ route('admin.user.register.form.create') }}"><i class="bx bx-right-arrow-alt"></i>Add user</a></li>
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
        <li> <a href="{{ route('admin.list.task') }}"><i class="bx bx-right-arrow-alt"></i>List task</a>
        </li>
        <li> <a href="component-badges.html"><i class="bx bx-right-arrow-alt"></i>Today Task</a>
        <li> <a href="component-badges.html"><i class="bx bx-right-arrow-alt"></i>All task</a>
        </li>
        <li> <a href="component-buttons.html"><i class="bx bx-right-arrow-alt"></i>Complete task</a>
        </li>
        <li> <a href="component-cards.html"><i class="bx bx-right-arrow-alt"></i>Pending task</a>
        </li>
        <li> <a href="component-carousels.html"><i class="bx bx-right-arrow-alt"></i>Confirm admission</a>
        </li>
        <li> <a href="component-list-groups.html"><i class="bx bx-right-arrow-alt"></i>Not interested</a>
        </li>
        <li> <a href="component-media-object.html"><i class="bx bx-right-arrow-alt"></i>Highly interested</a>
        </li>
        <li> <a href="component-modals.html"><i class="bx bx-right-arrow-alt"></i>Interested</a>
        </li>
        <li> <a href="component-navs-tabs.html"><i class="bx bx-right-arrow-alt"></i>Recall</a>
        </li>
      </ul>
    </li>
  </ul>
  <!--end navigation-->
</div>
