<?php
session_start();      //demarrage du session d'un utilisateur admin/clinet 
error_reporting(0);   //Désactiver tous les rapports d'erreurs

//  apper le fichier  includephp/connectiondb.php
include('includephp/connectionbd.php');

if (strlen($_SESSION['hotelanan']==0)) {
  	header('location:logout.php');
} else{  ?>
	<!DOCTYPE HTML>
	<html>
	<head>
		<title>Hôtel ANAN - Systéme de réservation | Tableau de bord</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- --------------------------- appel jquery --------------------------------- -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script><!-- -------------------------appel POLICE RANCHO------------------------------ -->
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		
		<!-- -------------------------appel POLICE RANCHO------------------------------ -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Rancho&display=swap" rel="stylesheet">
		<!--  ------------------------appel fichier style.css----------------------   -->
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
		<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
		<!-- -------------------------APPEL BOOTSTRAP-------------------------------- -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
			
		<!-- Graph CSS -->
		<link href="css/font-awesome.css" rel="stylesheet">
	</head> 
	<body>
		<div class="page-container">
			<!--/content-inner-->
			<div class="left-content">
				<div class="inner-content">
					<!-- header-starts -->
					<?php include_once('includephp/header.php');?>
					<!-- //header-ends -->
					<!--content-->
					<div class="content">
						<div class="col-md-12">
							<div class="row">
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="content-top-1">
										<h4 class="text-left text-uppercase" style="color: orange"><a href="new-booking.php"><b>Nouvelle réservation</b></a></h4>
										<div class="row vertical-center-box vertical-center-box-tablet">
											<?php 
												$sql2 ="SELECT * from  booking where Status is null ";
												$query2 = $dbh -> prepare($sql2);
												$query2->execute();
												$results2=$query2->fetchAll(PDO::FETCH_OBJ);
												$totnewbooking=$query2->rowCount();
											?><br><?php
												$sql1 ="SELECT * from  booking";
												$query1 = $dbh -> prepare($sql1);
												$query1->execute();
												$results1=$query1->fetchAll(PDO::FETCH_OBJ);
												$allbooking=$query1->rowCount();
												$percentage=0;
												if ($totnewbooking>0 && $allbooking>0){
													$percentage= round( ($totnewbooking/$allbooking)*100 , 2);
												}
											?>
											<div class="col-xs-3 mar-bot-15 text-left">
												<label class="label bg-green"><?php echo htmlentities($percentage);?>%</i></label>
											</div>
											<div class="col-xs-9 cus-gh-hd-pro">
												<h2 class="text-right no-margin"><?php echo htmlentities($totnewbooking);?>&nbsp;sur&nbsp;<?php echo htmlentities($allbooking);?></h2>
											</div>
										</div>
										<div class="progress progress-mini">
											<div style="width: <?php echo htmlentities($percentage);?>%;" class="progress-bar bg-success"></div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="margin-bottom:1px;">
									<div class="content-top-1">
										<h4 class="text-left text-uppercase" style="color: red"><a href="approved-booking.php"><b>Réservation approuvée</b></a></h4>
										<div class="row vertical-center-box vertical-center-box-tablet">
											<?php 
												$sql2 ="SELECT * from  booking where Status='approuvée'";
												$query2 = $dbh -> prepare($sql2);
												$query2->execute();
												$results2=$query2->fetchAll(PDO::FETCH_OBJ);
												$totappbooking=$query2->rowCount();
											?><br><?php
												$sql1 ="SELECT * from  booking";
												$query1 = $dbh -> prepare($sql1);
												$query1->execute();
												$results1=$query1->fetchAll(PDO::FETCH_OBJ);
												$allbooking=$query1->rowCount();
												$percentage=0;
												if ($totappbooking>0 && $allbooking>0){
													$percentage= round( ($totappbooking/$allbooking)*100 , 2);
												}
											?>
											<div class="text-left col-xs-3 mar-bot-15">
												<label class="label bg-red"><?php echo htmlentities($percentage);?>%</i></label>
											</div>
											<div class="col-xs-9 cus-gh-hd-pro">
												<h2 class="text-right no-margin"><?php echo htmlentities($totappbooking);?>&nbsp;sur&nbsp;<?php echo htmlentities($allbooking);?></h2>
											</div>
										</div>
										<div class="progress progress-mini">
											<div style="width: <?php echo htmlentities($percentage);?>%;" class="progress-bar bg-danger"></div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="content-top-1">
										<h4 class="text-left text-uppercase" style="color: magenta"><a href="cancelled-booking.php"><b>Réservation annulée</b></a></h4>
										<div class="row vertical-center-box vertical-center-box-tablet">
											<?php 
												$sql2 ="SELECT * from  booking where Status='annulée'";
												$query2 = $dbh -> prepare($sql2);
												$query2->execute();
												$results2=$query2->fetchAll(PDO::FETCH_OBJ);
												$totcanbooking=$query2->rowCount();
											?><br><?php
												$sql2 ="SELECT * from  booking";
												$query2 = $dbh -> prepare($sql2);
												$query2->execute();
												$results2=$query2->fetchAll(PDO::FETCH_OBJ);
												$allbooking=$query2->rowCount();
												$percentage=0;
												if ($totcanbooking>0 && $allbooking>0){
													$percentage= round( ($totcanbooking/$allbooking)*100 , 2);
												}
											?>
											<div class="text-left col-xs-3 mar-bot-15">
												<label class="label bg-blue"><?php echo htmlentities($percentage);?>%</i></label>
											</div>
											<div class="col-xs-9 cus-gh-hd-pro">
												<h2 class="text-right no-margin"><?php echo htmlentities($totcanbooking);?>&nbsp;sur&nbsp;<?php echo htmlentities($allbooking);?></h2>
											</div>
										</div>
										<div class="progress progress-mini">
											<div style="width: <?php echo htmlentities($percentage);?>%;" class="progress-bar bg-info"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12" style="padding-top: 20px">
							<div class="row">
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="content-top-1">
										<h4 class="text-left text-uppercase" style="color: orange"><a href="reg-users.php"><b>Utilisateurs enregistrés</b></a></h4>
										<div class="row vertical-center-box vertical-center-box-tablet">
											<?php 
												$sql1 ="SELECT * from  user";
												$query1 = $dbh -> prepare($sql1);
												$query1->execute();
												$results1=$query1->fetchAll(PDO::FETCH_OBJ);
												$totregusers=$query1->rowCount();
											?><br><?php
												$sql2 ="SELECT * from  user";
												$query2 = $dbh -> prepare($sql2);
												$query2->execute();
												$results2=$query2->fetchAll(PDO::FETCH_OBJ);
												$allbooking=$query2->rowCount();
												$percentage=0;
												if ($totregusers>0 && $allbooking>0){
													$percentage= round( ($totregusers/$allbooking)*100 , 2);
												}
											?>
											<div class="col-xs-3 mar-bot-15 text-left">
												<label class="label bg-green"><?php echo htmlentities($percentage);?>%</i></label>
											</div>
											<div class="col-xs-9 cus-gh-hd-pro">
												<h2 class="text-right no-margin"><?php echo htmlentities($totregusers);?>&nbsp;sur&nbsp;<?php echo htmlentities($allbooking);?></h2>
											</div>
										</div>
										<div class="progress progress-mini">
											<div style="width: <?php echo htmlentities($percentage);?>%;" class="progress-bar bg-success"></div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="margin-bottom:1px;">
									<div class="content-top-1">
										<h4 class="text-left text-uppercase" style="color: red"><a href="read-enquiry.php"><b>Message déjà lue</b></a></h4>
										<div class="row vertical-center-box vertical-center-box-tablet">
											<?php 
												$sql1 ="SELECT * from  contact where Isread='1'";
												$query1 = $dbh -> prepare($sql1);
												$query1->execute();
												$results1=$query1->fetchAll(PDO::FETCH_OBJ);
												$totreadqueries=$query1->rowCount();
											?><br><?php
												$sql2 ="SELECT * from  contact";
												$query2 = $dbh -> prepare($sql2);
												$query2->execute();
												$results2=$query2->fetchAll(PDO::FETCH_OBJ);
												$allbooking=$query2->rowCount();
												$percentage=0;
												if ($totreadqueries>0 && $allbooking>0){
													$percentage= round( ($totreadqueries/$allbooking)*100 , 2);
												}
											?>
											<div class="text-left col-xs-3 mar-bot-15">
												<label class="label bg-red"><?php echo htmlentities($percentage);?>%</i></label>
											</div>
											<div class="col-xs-9 cus-gh-hd-pro">
												<h2 class="text-right no-margin"><?php echo htmlentities($totreadqueries);?>&nbsp;sur&nbsp;<?php echo htmlentities($allbooking);?></h2>
											</div>
										</div>
										<div class="progress progress-mini">
											<div style="width: <?php echo htmlentities($percentage);?>%;" class="progress-bar bg-danger"></div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="content-top-1">
										<h4 class="text-left text-uppercase" style="color: magenta"><a href="unread-enquiry.php"><b>Message non lue</b></a></h4>
										<div class="row vertical-center-box vertical-center-box-tablet">
											<?php 
												$sql1 ="SELECT * from  contact where Isread is null";
												$query1 = $dbh -> prepare($sql1);
												$query1->execute();
												$results1=$query1->fetchAll(PDO::FETCH_OBJ);
												$totunreadqueries=$query1->rowCount();
											?><br><?php
												$sql2 ="SELECT * from  contact";
												$query2 = $dbh -> prepare($sql1);
												$query2->execute();
												$results2=$query2->fetchAll(PDO::FETCH_OBJ);
												$allbooking=$query2->rowCount();
												$percentage=0;
												if ($totunreadqueries>0 && $allbooking>0){
													$percentage= round( ($totunreadqueries/$allbooking)*100 , 2);
												}
											?>
											<div class="text-left col-xs-3 mar-bot-15">
												<label class="label bg-blue"><?php echo htmlentities($percentage);?>%</i></label>
											</div>
											<div class="col-xs-9 cus-gh-hd-pro">
												<h2 class="text-right no-margin"><?php echo htmlentities($totunreadqueries);?>&nbsp;sur&nbsp;<?php echo htmlentities($allbooking);?></h2>
											</div>
										</div>
										<div class="progress progress-mini">
											<div style="width: <?php echo htmlentities($percentage);?>%;" class="progress-bar bg-info"></div>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="content-top">
							<?php include_once('includephp/footer.php');?>
						</div>
					<!--content-->
					</div>
				</div>
				<!--//content-inner-->
				<?php include_once('includephp/sidebar.php');?>
				<div class="clearfix"></div>		
			</div>		
		</div>
		<!--JavaScript Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
	</body>
	</html>
<?php }  ?>