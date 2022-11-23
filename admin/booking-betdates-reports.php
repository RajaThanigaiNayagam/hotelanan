<?php
session_start();      //demarrage du session d'un utilisateur admin/clinet 
error_reporting(0);   //Désactiver tous les rapports d'erreurs

//  apper le fichier  includephp/connectiondb.php
include('includephp/connectionbd.php');

if (strlen($_SESSION['hotelanan']==0)) {
  	header('location:logout.php');
} else{?>
	<!DOCTYPE HTML>
	<html>
		<head>
			<title>Hotel ANAN - Systéme de réservation | Rapport de réservation entre les dates</title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			
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
						<!--content-->
						<div class="content">
							<div class="women_main">
								<!-- start content -->
								<div class="grids">
									<div class="progressbar-heading grids-heading">
										<h2>Rapport de réservation entre les dates</h2>
									</div>
									<div class="panel panel-widget forms-panel">
										<div class="forms">
											<div class="form-grids widget-shadow" data-example-id="basic-forms"> 
												<div class="form-title">
													<h4>Rapport de réservation entre les dates :</h4>
												</div>
												<div class="form-body">
													
													<form method="post" action="booking-bwdates-reports-details.php">
													<div class="form-group"> <label for="exampleInputEmail1">Date de début:</label>  <input type="date" class="form-control" id="fromdate" name="fromdate" value="" required='true'> </div> 
													
													<div class="form-group"> <label for="exampleInputEmail1">Date de fin:</label>  <input type="date" class="form-control" id="todate" name="todate" value="" required='true'> </div>
													<button type="submit" class="btn btn-default" name="submit">Soumettre</button> </form> 
												</div>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
								<!-- end content -->
								<?php include_once('includephp/footer.php');?>
							</div>
						</div>
						<!--content-->
					</div>
				</div>
				<!--//content-inner-->
				<!--/sidebar-menu-->
				<?php include_once('includephp/sidebar.php');?>
				<div class="clearfix"></div>		
			</div>	
			<!--JavaScript Bundle with Popper -->
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
		</body>
	</html>
<?php }  ?>