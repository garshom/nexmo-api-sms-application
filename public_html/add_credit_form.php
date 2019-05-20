<?php
require_once("config.php");
if( $_POST ){
	
	$credits_toadd = trim((int)($_POST['credits_toadd']));
    $user_name = trim($_POST['load_usernames']);
	
	if($credits_toadd=="" || $user_name==""){
	?>
		<div class="alert alert-warning">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    		<strong>Failure</strong>, Please fill in all the required fields to proceed ...
		</div>
	<?php
		
	
	}else if(!$credits_toadd>0){
	?>
		<div class="alert alert-warning">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    		<strong>Failure</strong>, Please credits to add should be greater than zero ...
		</div>
		
	<?php
	}else{
	  
		//echo $_SESSION["user_id"];
		$credits_bal='select * from credits where user_id in (select u_userid from system_users where u_username="'.$user_name.'")';
		
		try{
			$stmt = $DB->prepare($credits_bal);
            if($stmt->execute()==1){
				$results = $stmt->fetchAll();
				if(count($results) > 0 && $results[0]["credits"]>0){
					$bal=trim((int)($results[0]["credits"]));
					$new_value=$bal+$credits_toadd;
					
					//log credit addition
					$sql='insert into credit_additions values("'.$results[0]["user_id"].'","'.$credits_toadd.'",NOW(),"'.$_SESSION["user_id"].'")';
					
					$sql2='update credits set credits="'.$new_value.'" where user_id="'.$results[0]["user_id"].'"';
					
					$stmt_insert=$DB->prepare($sql);
					$stmt_update=$DB->prepare($sql2);
					
					if($stmt_insert->execute()==1 && $stmt_update->execute()==1){
							?>
								<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
									<strong>Success</strong>, User Credits to <?php echo $user_name ?> have been added successfully....
								</div>
							<?php	
					}else{
							?>
								<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
									<strong>Failure</strong>, User Credits to <?php echo $user_name ?> have failed to be added....
								</div>
							<?php	
					
					}
			
				
				}else{
				  ?>
						<div class="alert alert-warning">
							<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
							<strong>Failure</strong>, User credits were not initialised with any amount  <?php echo $results[0];?>
						</div>
				  <?php 
				}
			}else{
			
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