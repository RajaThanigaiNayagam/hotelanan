<?php
session_start();      //demarrage du session d'un utilisateur admin/clinet 
error_reporting(0);   //Désactiver tous les rapports d'erreurs

//  apper le fichier  includephp/connectiondb.php
include('includephp/connectionbd.php');

if (strlen($_SESSION['hotelanan']==0)) {
   header('location:logout.php');
} else{
    if(isset($_POST['submit']))
  	{
	$hbmsaid=$_SESSION['hbmsaid'];
	$pagetitle=$_POST['pagetitle'];
	$pagedes=$_POST['pagedes'];
	$pagetitle=$_POST['pagetitle'];
	$pagedes=$_POST['pagedes'];
	$mobnum=$_POST['mobnum'];
	$email=$_POST['email'];
	$sql="update pageutil set PageTitle=:pagetitle,PageDescription=:pagedes,Email=:email,MobileNumber=:mobnum where  PageType='contactus'";
	$query=$dbh->prepare($sql);
	$query->bindParam(':pagetitle',$pagetitle,PDO::PARAM_STR);
	$query->bindParam(':pagedes',$pagedes,PDO::PARAM_STR);
	$query->bindParam(':email',$email,PDO::PARAM_STR);
	$query->bindParam(':mobnum',$mobnum,PDO::PARAM_STR);
	$query->execute();
	echo '<script>alert("Contactez-nous a été mis à jour")</script>';
	} ?>
	<!DOCTYPE HTML>
	<html>
		<head>
			<title>Hôtel ANAN - Systéme de réservation | Nous contacter</title>
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
						<!--content-->
						<div class="content">
							<div class="women_main">
								<!-- start content -->
								<div class="grids">
									<div class="progressbar-heading grids-heading">
										<h2>Nous contacter</h2>
									</div>
									<div class="panel panel-widget forms-panel">
										<div class="forms">
											<div class="form-grids widget-shadow" data-example-id="basic-forms"> 
												<div class="form-title">
													<h4>Nous contacter</h4>
												</div>
												<div class="form-body">
													<form method="post" enctype="multipart/form-data">
														<?php
														$sql="SELECT * from  pageutil where PageType='contactus'";
														$query = $dbh -> prepare($sql);
														$query->execute();
														$results=$query->fetchAll(PDO::FETCH_OBJ);
														$cnt=1;
														if($query->rowCount() > 0)
														{
															foreach($results as $row)
															{               ?>
																<div class="form-group"> <label for="exampleInputEmail1">Titre de la page</label> <input type="text" name="pagetitle" id="pagetitle" required="true" value="<?php  echo $row->PageTitle;?>" class="form-control"> </div>
																<div class="form-group"> <label for="exampleInputEmail1">E-mail</label> <input type="text" name="email" id="email" required="true" value="<?php  echo $row->Email;?>" class="form-control"> </div>
																<div class="form-group"> <label for="exampleInputEmail1">Numéro de portable</label> <input type="text" name="mobnum" id="mobnum" required="true" value="<?php  echo $row->MobileNumber;?>" class="form-control"> </div>
																<div class="form-group"> <label for="exampleInputEmail1">Description de la page</label> <textarea type="text" name="pagedes" id="pagedes" required="true"class="form-control"><?php  echo $row->PageDescription;?></textarea> </div>
																<?php $cnt=$cnt+1;
															}
														} ?> 
														<button type="submit" class="btn btn-default" name="submit">Mise à jour</button> 
													</form> 
												</div>
												<div class="clearfix"></div>
											</div>
										</div>
									</div>
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