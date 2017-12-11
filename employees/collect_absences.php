<?php
  require_once "./../config.php";
  require CLASSES."DB.php";
  require CLASSES."Session.php";
  Session::setUp();
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
<div class="Container">
  <div class="row">

    <div class="col-md-10">
      <br><br>
    </div>
  </div>
<div class="row">
<div class="col-md-2"></div>  
<div class="col-md-8 center">
  

 <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Affect Mission </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form">
                <!-- text input -->
          
               <div class="form-group">
                  <label>Select Mission</label>
                  <select class="form-control">
                    <option>Android Application ClientX </option>
                    <option>Web site with AngularJS ONCF</option>
                    
                  </select>
                </div>

          <div class="form-group">
                <label>Start Date:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" data-inputmask="'alias': '02/12/2017'" placeholder="02/12/2017" data-mask="" disabled="">
                </div>
                <!-- /.input group -->
              </div>

         <div class="form-group">
                <label>End Date:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" data-inputmask="'alias': '02/04/2018'" placeholder="02/04/2018" data-mask="" disabled="">
                </div>
                <!-- /.input group -->
              </div>


                <!-- textarea -->
                <div class="form-group">
                  <label>Description: </label>
                  <textarea class="form-control" rows="3" placeholder="Enter ..." disabled=""></textarea>
                </div>
               
              

       <br>  
             
    <label>Table Employees</label><br>
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
                        <th><input type="text" class="form-control" placeholder="Type Mission" disabled=""></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Id1253</td>
                        <td>Khalid</td>
                        <td>Jamali</td>
                        <td>Leader team</td>
                        <td>
                  <select class="form-control">
                    <option>Mission </option>
                    <option>Project</option>
                  </select>
                        </td>
                    </tr>
                    <tr>
                        <td>IN12211</td>
                        <td>Salim</td>
                        <td>Brahmi</td>
                        <td>Devlopper</td>
                        <td>
                  <select class="form-control">
                    <option>Mission </option>
                    <option>Project</option>
                  </select>
                 </td>
                    </tr>
                    <tr>
                         <td>In12235</td>
                        <td>Khalid</td>
                        <td>Brahmi</td>
                        <td>Designer</td>
                        <td>
                  <select class="form-control">
                    <option>Mission </option>
                    <option>Project</option>
                  </select>
               </td>
                    </tr>
                    
                </tbody>
            </table>

            
        </div>

             <div class="box-footer">
              
                <button type="submit" class="btn btn-info">Affect Mission</button>
                 
              </div>


              </form>
            </div>
            <!-- /.box-body -->
          </div>



<!--colonne1-->
</div>
<!--row-->
</div>
<!-- Container -->
</div>
