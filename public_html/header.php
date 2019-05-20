<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="lexus.ico" type="image/x-icon" />
        <meta name="author" content="nexmo api sms application">
        <meta name="keywords" content="Nexmo API SMS Application">

        <title><?php echo PROJECT_NAME ?> - Nexmo API SMS Application</title>

        <!-- Bootstrap -->
		
		<link href="bootstrap/table/bootstrap3.min.css" rel="stylesheet">
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="bootstrap/table/dataTables.bootstrap.min.css" rel="stylesheet">
        
        <link href="bootstrap/css/bootstrap-social.css" rel="stylesheet">
        <link href="bootstrap/css/font-awesome.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">
				
        

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="bootstrap/html5shiv.js"></script>
          <script src="bootstrap/respond.min.js"></script>
        <![endif]-->
    </head>
    <body style="font-style: italic;">

       
        <div class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container-fluid">
              
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="./" target="_blank"><span class="fa fa-home"></span> Nexmo API SMS Application</a>
                </div>
				
				<?php
				 if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "") { ?>
				 <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1" >
                    <ul class="nav navbar-nav">
						<li><a id="load_credit_balance"> </a></li>
						<li> <a href="logout.php"><button class="btn-primary btn" type="button"><i class="fa fa-sign-out"></i>Logout</button></a> </li>
                    </ul>
					
                </div>
				
				 <?php } else { ?>
				 
				 <?php } ?>

            </div>

        </div>

        <div class="container mainbody">
            <div class="page-header">
                <h1><?php echo $title ?></h1>
            </div>
            <div class="clearfix"></div>
            <div class="clearfix"></div>
            <div class="container-fluid">
