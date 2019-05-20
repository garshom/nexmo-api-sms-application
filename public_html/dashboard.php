<?php

require_once("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}

// set page title
$title = "Compose SMS";


include 'header.php';
?>
<div style="height: 10px;">&nbsp;</div>

<div class="row">
    <div class="col-lg-9">
        
		<div id="success_msg"></div>
		<div class="well well-sm">
		<form class="form-horizontal" name="send_msg_form" id="send_msg_form" method="post">

            
                <div class="form-group">
                    <label class="col-lg-3 control-label" ><span></span>SENDER NO :</label>
                    <div class="col-lg-9">
                        <input type="text" value="" placeholder="00254783456789" class="form-control" id="sender_id" name="sender_id" required="" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label" ><span ></span>RECEPIENT NO:</label>
                    <div class="col-lg-9">
                        <input type="text" value="" placeholder="0025478345999" id="recepient_number" class="form-control" name="recepient_number" required="" />
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-lg-3 control-label"><span ></span>COMPOSE MESSAGE:</label>
                    <div class="col-lg-9">
                        <textarea rows="5" cols="50" id="send_message" class="form-control" value="" name="send_message" required="" style="resize: none; resize: vertical" ></textarea>
						<h6 class="pull-right" id="count_message"></h6>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-9 col-lg-offset-10">
                        <button class="btn btn-primary fa fa-sign-out" type="submit">Submit</button> 
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
        <?php include 'sidebar.php'; ?>
    </div>

</div>
<?php include 'footer.php'; ?>