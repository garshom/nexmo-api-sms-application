<?php
require_once("config.php");

	$credits_query='select m.DateTime,u.u_username,m.sender_id,m.recepient_id,m.message_sent,m.credit_balance_before,m.credit_balance_after from message_info m,system_users u where m.user_id=u.u_userid order by m.datetime desc;';
	try{
			$stmt = $DB->prepare($credits_query);
			
			if($stmt->execute()==1){
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				if(count($results) > 0){
				    ?>
					<table id="example_all" class="table table-striped table-bordered" width="100%" cellspacing="0" >
						<thead>
							<tr>
								<th>DATE TIME</th>
								<th>USERNAME</th>
								<th>FROM</th>
								<th>MESSAGE SENT</th>
								<th>TO</th>
								<th>CREDITS_BEFORE</th>
								<th>CREDITS_AFTER</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>DATE TIME</th>
								<th>USERNAME</th>
								<th>FROM</th>
								<th>MESSAGE SENT</th>
								<th>TO</th>
								<th>CREDITS_BEFORE</th>
								<th>CREDITS_AFTER</th>
							</tr>
						</tfoot>
						<tbody>
					
					<?php
					foreach($results as $row) {
					 ?>
						<tr style="font-style: italic;">
							<td><?php echo $row['DateTime'];?></td>
							<td><?php echo $row['u_username'];?> </td>
							<td><?php echo $row['sender_id'];?> </td>
							<td><?php echo $row['message_sent'];?></td>
							<td><?php echo $row['recepient_id'];?></td>
							<td><?php echo $row['credit_balance_before'];?></td>
							<td><?php echo $row['credit_balance_after'];?></td>
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
	
