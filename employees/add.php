<?php
	require_once "./../config.php";
	require_once ROOT_URL."database/connect.php";
	require_once SESSIONS."setUp.php";
	require_once INC."topHTML.php";
	require_once INC."header.php";
	require_once INC."aside.php";

?>

<div class="content-wrapper">
	    <section class="content">
	      <div class="row">
	        <div class="col-md-12">
	        	<div class="box box-warning">
		            <div class="box-header with-border">
		              <h3 class="box-title">Add a new Employee</h3>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		              <form role="form">
		                <!-- text input -->
		                <div class="form-group">
		                  <label>CIN</label>
		                  <input class="form-control" name="cin" type="text">
		                </div>
		                <div class="form-group">
		                  <label>First Name</label>
		                  <input class="form-control" name="" type="text">
		                </div>

		                <!-- textarea -->
		                <div class="form-group">
		                  <label>Textarea</label>
		                  <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
		                </div>
		                <div class="form-group">
		                  <label>Textarea Disabled</label>
		                  <textarea class="form-control" rows="3" placeholder="Enter ..." disabled=""></textarea>
		                </div>

		                <!-- input states -->
		                <div class="form-group has-success">
		                  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Input with success</label>
		                  <input class="form-control" id="inputSuccess" placeholder="Enter ..." type="text">
		                  <span class="help-block">Help block with success</span>
		                </div>
		                <div class="form-group has-warning">
		                  <label class="control-label" for="inputWarning"><i class="fa fa-bell-o"></i> Input with
		                    warning</label>
		                  <input class="form-control" id="inputWarning" placeholder="Enter ..." type="text">
		                  <span class="help-block">Help block with warning</span>
		                </div>
		                <div class="form-group has-error">
		                  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Input with
		                    error</label>
		                  <input class="form-control" id="inputError" placeholder="Enter ..." type="text">
		                  <span class="help-block">Help block with error</span>
		                </div>

		                <!-- checkbox -->
		                <div class="form-group">
		                  <div class="checkbox">
		                    <label>
		                      <input type="checkbox">
		                      Checkbox 1
		                    </label>
		                  </div>

		                  <div class="checkbox">
		                    <label>
		                      <input type="checkbox">
		                      Checkbox 2
		                    </label>
		                  </div>

		                  <div class="checkbox">
		                    <label>
		                      <input disabled="" type="checkbox">
		                      Checkbox disabled
		                    </label>
		                  </div>
		                </div>

		                <!-- radio -->
		                <div class="form-group">
		                  <div class="radio">
		                    <label>
		                      <input name="optionsRadios" id="optionsRadios1" value="option1" checked="" type="radio">
		                      Option one is this and that—be sure to include why it's great
		                    </label>
		                  </div>
		                  <div class="radio">
		                    <label>
		                      <input name="optionsRadios" id="optionsRadios2" value="option2" type="radio">
		                      Option two can be something else and selecting it will deselect option one
		                    </label>
		                  </div>
		                  <div class="radio">
		                    <label>
		                      <input name="optionsRadios" id="optionsRadios3" value="option3" disabled="" type="radio">
		                      Option three is disabled
		                    </label>
		                  </div>
		                </div>

		                <!-- select -->
		                <div class="form-group">
		                  <label>Select</label>
		                  <select class="form-control">
		                    <option>option 1</option>
		                    <option>option 2</option>
		                    <option>option 3</option>
		                    <option>option 4</option>
		                    <option>option 5</option>
		                  </select>
		                </div>
		                <div class="form-group">
		                  <label>Select Disabled</label>
		                  <select class="form-control" disabled="">
		                    <option>option 1</option>
		                    <option>option 2</option>
		                    <option>option 3</option>
		                    <option>option 4</option>
		                    <option>option 5</option>
		                  </select>
		                </div>

		                <!-- Select multiple-->
		                <div class="form-group">
		                  <label>Select Multiple</label>
		                  <select multiple="" class="form-control">
		                    <option>option 1</option>
		                    <option>option 2</option>
		                    <option>option 3</option>
		                    <option>option 4</option>
		                    <option>option 5</option>
		                  </select>
		                </div>
		                <div class="form-group">
		                  <label>Select Multiple Disabled</label>
		                  <select multiple="" class="form-control" disabled="">
		                    <option>option 1</option>
		                    <option>option 2</option>
		                    <option>option 3</option>
		                    <option>option 4</option>
		                    <option>option 5</option>
		                  </select>
		                </div>

		              </form>
		            </div>
		            <!-- /.box-body -->
		          </div>
			</div>
		</div>
	</section>
</div>