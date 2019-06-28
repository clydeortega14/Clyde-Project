<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ auth()->user()->username }}</p>
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
      <ul class="sidebar-menu" data-widget="tree">

        <li class="header">MAIN NAVIGATION</li>

        <li>
          <a href="{{ route('home') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-group"></i> <span>Access Rights</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            <ul class="treeview-menu">
              <li>
                <a href="{{ route('users') }}">
                   <span>Users</span>
                </a>
              </li>

              <li>
                <a href="#">
                   <span>Roles</span>
                </a>
              </li>

              <li>
                <a href="#">
                  <span>Permissions</span>
                </a>
              </li>
            </ul>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-gears"></i> <span>Set up</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            <ul class="treeview-menu">
              
              <li>
                <a href="{{ route('cars') }}">
                  <i class="fa fa-car"></i> <span>Cars</span>
                </a>
              </li>

              <li>
                <a href="{{ route('customers.index') }}">
                  <i class="fa fa-user"></i> <span>Customers</span>
                </a>
              </li>
              
              <li>
                <a href="{{ route('drivers.index') }}">
                  <i class="fa fa-user"></i> <span>Drivers</span>
                </a>
              </li>

              <li>
                <a href="{{ route('tour-packages.index') }}">
                  <i class="fa fa-ship"></i> <span>Tour Packages</span>
                </a>
              </li>

              <li>
                <a href="{{ route('destinations.index') }}">
                  <i class="fa fa-ship"></i> <span>Destinations</span>
                </a>
              </li>

              <li>
                <a href="{{ route('penalties.index') }}">
                  <i class="fa fa-ship"></i> <span>Penalties</span>
                </a>
              </li>
            </ul>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Transactions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu">
              <li>
                <a href="{{ route('rent.list') }}">
                    <i class="fa fa-car"> </i><span> Reservations </span>
                </a>
              </li>

               <li>
                <a href="{{ route('payments.index') }}">
                    <i class="fa fa-credit-card"> </i><span> Payments </span>
                </a>
              </li>
            </ul>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
</aside>