<?php

require_once("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}

// set page title
$title = "User Messages Sent";


include 'header.php';
?>
<div style="height: 10px;">&nbsp;</div>


    <div class="col-lg-13">

        
		<div id="table_data" style="font-style: italic;">
		
		
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


<?php include 'footer.php'; ?>