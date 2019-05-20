<?php
require_once("config.php");
if( $_POST ){
	
	$rolecode_id = trim($_POST['load_roles']);
    $user_email = trim($_POST['user_email']);
	$password=trim($_POST['password']);
	
	if($rolecode_id=="" || $user_email=="" || $password==""){
	?>
		<div class="alert alert-warning">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    		<strong>Failure</strong>, Please fill in all the required fields to proceed ...
		</div>
	<?php
		
	
	}else if(!preg_match("/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/", $user_email)){
	?>
		<div class="alert alert-warning">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    		<strong>Failure</strong>, Please Username (Email ID) provided is not valid ...
		</div>
		
	<?php
	}else{
	   
	  try{
			
			$sql='replace into system_users(u_username,u_password,u_rolecode) values("'.$user_email.'","'.md5($password).'","'.$rolecode_id.'");';
			$stmt = $DB->prepare($sql);
			if($stmt->execute()==1 ){
			
				$insert_sql='replace into credits values((select u_userid from system_users where u_username="'.$user_email.'"),1)';
				$stmt_insert=$DB->prepare($insert_sql);
				if($stmt_insert->execute()==1){
								?>
												<div class="alert alert-success">
													<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
													<strong>Success</strong>, New User has been added successfully ....
												</div>
								<?php	
				}else{
								?>
												<div class="alert alert-success">
													<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
													<strong>Failure </strong>, User added but credit initialisation failed ....
												</div>
								<?php	
				}
				
								
			
			}else{
			 ?>
								<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
									<strong>Failure </strong>, User addition has failed, please provide neccessary details and try again ....
								</div>
			<?php	
			
			}
			
			
		}catch(Exception $ex){
		
			  ?>
				  <div class="alert alert-warning">
					<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
					<strong>Failure</strong>, <?php echo $ex; ?> ...
				  </div>		
			  <?php
		}
		
	 }

	?>
    
   
	
    <?php
	
}