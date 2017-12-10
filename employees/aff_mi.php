<?php
	require_once "./../config.php";
	require_once ROOT_URL."database/connect.php";
	require_once SESSIONS."setUp.php";
	require_once INC."topHTML.php";
	require_once INC."header.php";
	require_once INC."aside.php";

?>
<div class="content-wrapper" style="min-height: 921px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
<div class="Container">
  <div class="row">
    <div class="col-md-10">
      <br><br>
    </div>
  </div>
<div class="row">
  
<div class="col-md-10 center">
  

 <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Collect Absence </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form">


            <div class="form-group">
                <label>Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" placeholder="Entre the date you wante ...." id="datepicker">
                </div>
                <!-- /.input group -->
              </div>


<label>Table Employees</label><br><br>
        <div class="panel panel-primary filterable">

            <div class="panel-heading">
                <h3 class="panel-title">Employees</h3>
               
            </div>
            <table class="table">
                <thead>
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="CIN" disabled=""></th>
                        <th><input type="text" class="form-control" placeholder="First Name" disabled=""></th>
                        <th><input type="text" class="form-control" placeholder="Last Name" disabled=""></th>
                        <th><input type="text" class="form-control" placeholder="Grade" disabled=""></th>
                        <th><input type="text" class="form-control" placeholder="Mark Absence" disabled=""></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Id1253</td>
                        <td>Khalid</td>
                        <td>Jamali</td>
                        <td>Leader team</td>
                        <td>
                  Present   <i class="fa fa-chevron-down  pull-right ico"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>IN12211</td>
                        <td>Salim</td>
                        <td>Brahmi</td>
                        <td>Devlopper</td>
                        <td>
                  Present   <i class="fa fa-chevron-down  pull-right ico"></i>
                 </td>
                    </tr>
                    <tr>
                         <td>In12235</td>
                        <td>Khalid</td>
                        <td>Brahmi</td>
                        <td>Designer</td>
                        <td>
                  Absent    <i class="fa fa-times pull-right icoa"></i>
               </td>
                    </tr>
                    
                </tbody>
            </table>

            
        </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>

