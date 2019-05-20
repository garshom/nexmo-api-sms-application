<?php
require_once("config.php");

	$credits_query='select * from message_info where user_id="'.$_SESSION["user_id"].'" order by datetime desc limit 3;';
	try{
			$stmt = $DB->prepare($credits_query);
			
			if($stmt->execute()==1){
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				if(count($results) > 0){
					foreach($results as $row) {
					 ?>
						<div  class="page-header" style="height: 4px;">&nbsp;</div>
						<strong><?php echo $row['DateTime']. " ";?></strong> <strong> FROM: <?php echo $row['sender_id']." ";?>  Message  </strong>   <?php echo " ". $row['message_sent'];?> <strong> TO: <?php echo $row['recepient_id'];?></strong>
						
					
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
	
