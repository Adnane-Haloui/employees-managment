 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['first_name'];?></p>
           <h5><?php echo $_SESSION['job_title'];?></h5>&nbsp;&nbsp;&nbsp;
          <a href="#"> <i class="fa fa-circle text-success"></i> Online</a>
          
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
        <li class="header">Personal Information</li>
        <li class="active treeview">
          <a href="<?php echo APP_URL.'dashboard.php'; ?>">
            <i class="fa fa-user"></i> <span>General Information</span>
            <span class="pull-right-container">
          
            </span>
          </a>
        </li>

        <li class="header">Career Track</li>
  
        <li class="treeview">
          <a href="CareerEvolution.html">
            <i class="fa fa-line-chart"></i> <span>Career Evolution</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

          <li class="treeview">
          <a href="#">
            <i class="fa fa-user-secret"></i> <span>Missions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
            <li>
            <li class="active"><a href="CurrentMissions.html"><i class="fa fa-circle-o"></i> Current Missions</a></li>
            <li><a href="MissionsOld.html"><i class="fa fa-circle-o"></i> Old Missions</a></li>
            </li>

          </ul>
        </li>
     
      </ul>


    </section>
    <!-- /.sidebar -->
  </aside>
