<?php
  require_once ROOT_URL.'vendor/Carbon.php';
  /*
   * Carbon zeto hna, bach n9edo n7ewlo date 3adia
   * l format m9roa,  b7al men hadi'dd.mm.yyyy hh:mm:ss' l hadi 1st of december, etc
   */

  use Carbon\Carbon;
  $date_format = 'jS \\of F Y';
  $date = new Carbon($_SESSION['created_at']);
  $date = $date->format($date_format);
?>

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo APP_URL; ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><?php echo APP_NAME; ?></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?php echo APP_NAME; ?></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs">
                <?php echo $_SESSION['last_name']; ?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <p>
                  <?php echo  $_SESSION['last_name'].' '.$_SESSION['first_name']." - ".$_SESSION['job_title']; ?>
                  <small>member since <?php echo $date; ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo APP_URL.'employees/profile.php'; ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo APP_URL.'sessions/logout.php'; ?>" class="btn btn-default btn-flat">Log out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>

    </nav>
  </header>

