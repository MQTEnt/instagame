<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="/img/user.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Name</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="{{ Route::is('dashboard.*') ? 'active' : '' }} treeview">
        <a href="{{ route('dashboard.index')}}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="{{ Route::is('tag.*') ? 'active' : '' }} treeview">
        <a href="{{ route('tag.index')}}">
          <i class="fa fa-tags"></i> <span>Tags management</span>
        </a>
      </li>
      <li class="{{ Route::is('item.*') ? 'active' : '' }} treeview">
        <a href="{{ route('item.index')}}">
          <i class="fa fa-cubes"></i> <span>Items management</span>
        </a>
      </li>
      <li class="{{ Route::is('game.*') ? 'active' : '' }} treeview">
        <a href="{{ route('game.index')}}">
          <i class="fa fa-gamepad"></i> <span>Games management</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>