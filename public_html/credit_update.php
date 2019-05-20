<?php
require_once("config.php");

	$credits_query='select * from credits where user_id="'.$_SESSION["user_id"].'"';
	try{
			$stmt = $DB->prepare($credits_query);
			
			if($stmt->execute()==1){
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				if(count($results) > 0){
					 ?>
						<button class="btn-primary btn" type="button"><i class="fa"></i> <?php echo $results[0]['credits']." Credits Remaining"?></button>
					 <?php
					 
				}else{
				
				}
			
			}else{
			
			}
	
	}catch(Exception $ex){
	 
	}

	?>
    
	
    <?php
	
