<?php
require_once("config.php");

	$credits_query='select * from role';
	try{
			$stmt = $DB->prepare($credits_query);
			
			if($stmt->execute()==1){
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				if(count($results) > 0){
					foreach($results as $row) {
					 ?>
						<option value=" <?php echo $row['role_rolecode']?>"><?php echo $row['role_rolename']?></option>
					
					 <?php
					 }
					 
				}else{
				
				}
			
			}else{
			
			}
	
	}catch(Exception $ex){
	 
	}

	?>
    
	
    <?php
	
