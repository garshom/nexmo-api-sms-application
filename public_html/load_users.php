<?php
require_once("config.php");

	//$user_query='select s.u_userid,s.u_username,s.u_rolecode, (select count(*) from message_info m) As message_count, (select credits from credits c) AS credit_balance from system_users s, message_info m, credits c where s.u_userid=c.user_id and s.u_userid=m.user_id and s.u_userid!=null group by s.u_userid';
	$user_query='select s.u_userid,s.u_username,s.u_rolecode, count(m.message_sent) as message_count, c.credits as credit_balance from system_users s, message_info m, credits c where s.u_userid=c.user_id and s.u_userid=m.user_id group by s.u_userid';
	try{
			$stmt = $DB->prepare($user_query);
			
			if($stmt->execute()==1){
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				if(count($results) > 0){
				    ?>
					<table id="users_example" class="table table-striped table-bordered" width="100%" cellspacing="0" >
						<thead>
							<tr>
								<th>USERNAME</th>
								<th>USERROLE</th>
								<th>MESSAGE SENT COUNT</th>
								<th>CREDIT BALANCE</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>USERNAME</th>
								<th>USERROLE</th>
								<th>MESSAGE SENT COUNT</th>
								<th>CREDIT BALANCE</th>
							</tr>
						</tfoot>
						<tbody>
					
					<?php
					foreach($results as $row) {
					 ?>
						<tr style="font-style: italic;">
							<td><?php echo $row['u_username'];?></td>
							<td><?php echo $row['u_rolecode'];?> </td>
							<td><?php echo $row['message_count'];?></td>
							<td><?php echo $row['credit_balance'];?></td>
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
	
