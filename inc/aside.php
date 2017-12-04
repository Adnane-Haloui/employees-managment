 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo APP_URL.$_SESSION['avatar']; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['first_name'];?></p>
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
        <li class="treeview">
          <a href="<?php echo APP_URL.'employees/profile.php'; ?>">
            <i class="fa fa-user"></i> <span>General Information</span>
            <span class="pull-right-container">
          
            </span>
          </a>
        </li>

        <li class="header">Career Track</li>
  
        <li class="treeview">
          <a href="#">
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
            <li class="active"><a href="#"><i class="fa fa-circle-o"></i> Current Missions</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Old Missions</a></li>
          </ul>
        </li>
        <?php 
          if($_SESSION['job_type'] == 2 ) {
            if($_SESSION['service_type'] == 'd')
              include_once INC."aside/service_dev.php";
            else if($_SESSION['service_type'] == 'rh')
              include_once INC."aside/service_rh.php";
          } else if($_SESSION['job_type'] == 3) {
            include_once INC.'aside/department_dev.php';
          }
        ?>
      </ul>


    </section>
    <!-- /.sidebar -->
  </aside>
