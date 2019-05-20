<?php
require_once("config.php");

	$credits_query='select * from message_info where user_id="'.$_SESSION["user_id"].'" order by datetime desc';
	try{
			$stmt = $DB->prepare($credits_query);
			
			if($stmt->execute()==1){
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				if(count($results) > 0){
				    ?>
					<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0" >
						<thead>
							<tr>
								<th>DATE TIME</th>
								<th>FROM</th>
								<th>MESSAGE SENT</th>
								<th>TO</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>DATE TIME</th>
								<th>FROM</th>
								<th>MESSAGE SENT</th>
								<th>TO</th>
							</tr>
						</tfoot>
						<tbody>
					
					<?php
					foreach($results as $row) {
					 ?>
						<tr style="font-style: italic;">
							<td><?php echo $row['DateTime'];?></td>
							<td><?php echo $row['sender_id'];?> </td>
							<td><?php echo $row['message_sent'];?></td>
							<td><?php echo $row['recepient_id'];?></td>
						</tr>
					
					 <?php
					 }
					 ?>
						</tbody>
					</table>
					 <?php
					 
				}else{
				
				}
			
			}else{
			
			}
	
	}catch(Exception $ex){
	 
	}

	?>
    
	
    <?php
	
