<?php

require_once("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}

// set page title
$title = "Add New User";


include 'header.php';
?>
<div style="height: 10px;">&nbsp;</div>

<div class="row">
    <div class="col-lg-9">
        
		<div id="success_msg"></div>
		<div class="well well-sm">
		<div style="height: 10px;">&nbsp;</div>
		<form class="form-horizontal" name="create_user_form" id="create_user_form" method="post">

            
                <div class="form-group">
                    <label class="col-lg-3 control-label" ><span></span>USERNAME (EMAIL) :</label>
                    <div class="col-lg-9">
                        <input type="text" value="" placeholder="info@hotmail.com" class="form-control" id="user_email" name="user_email" required="" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label" ><span ></span>USER PASSWORD:</label>
                    <div class="col-lg-9">
                        <input type="password" value="" placeholder="Password" id="password" class="form-control" name="password" required="" />
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-lg-3 control-label"><span ></span>USER ROLES:</label>
                    <div class="col-lg-9">
                        <select class="selectpicker" id="load_roles" name="load_roles"></select>
						
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-9 col-lg-offset-10">
                        <button class="btn btn-primary fa fa-sign-out" type="submit">Add User</button> 
                    </div>
                </div>
                 
				
            
        </form>
		
		</div>
		
		<div class="well well-sm">
                <div class="btn-group">
						<div class="btn-group">
							<button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Dashboard 
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
							<li><a href="<?php echo "./sent_messages.php" ?>"> <i class="fa fa-forward"></i><?php echo " Messages Sent   "?></a></li>
							<?php 
							if($_SESSION["rolecode"]=="SUPERADMIN"){
								?>
									<li><a href=" <?php echo "./users.php" ?> "> <i class="fa fa-forward"></i><?php echo " Approved Users   "?></a></li>
								<?php
							}
							?>
							
							</ul>
						</div>
                </div>
				<?php 
				if($_SESSION["rolecode"]=="SUPERADMIN"){
				    ?>
						<div class="btn-group">
							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> User Management 
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
								<li><a href=" <?php echo "./create_user.php" ?> "> <i class="fa fa-forward"></i><?php echo " Create User   "?></a></li>
								<li><a href="<?php echo "./all_messages.php" ?> "> <i class="fa fa-forward"></i><?php echo " Message Sent Statistics  "?></a></li>
								</ul>
							</div>
						</div>
								
					<?php	
					
				}
				?>
				
           
        </div>


    </div>
	
	<div class="col-lg-3">
        <?php include 'sidebar_addcredit.php'; ?>
    </div>
	
</div>
<?php include 'footer.php'; ?>