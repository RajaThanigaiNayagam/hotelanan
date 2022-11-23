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
    $adminid=$_SESSION['hbmsaid'];
    $AName=$_POST['adminname'];
	$mobno=$_POST['mobilenumber'];
	$email=$_POST['email'];
	$sql="update admin set AdminName=:adminname,MobileNumber=:mobilenumber,Email=:email where ID=:aid";
	$query = $dbh->prepare($sql);
	$query->bindParam(':adminname',$AName,PDO::PARAM_STR);
	$query->bindParam(':email',$email,PDO::PARAM_STR);
	$query->bindParam(':mobilenumber',$mobno,PDO::PARAM_STR);
	$query->bindParam(':aid',$adminid,PDO::PARAM_STR);
	$query->execute();
    echo '<script>alert("Profile has been updated")</script>';
     echo "<script>window.location.href ='profile.php'</script>";

  }
  ?>
  <!DOCTYPE HTML>
  <html>
	  <head>
		  <title>Hotel ANAN - Systéme de réservation | Profil</title>
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
										<h2>Profil administrateur</h2>
									</div>
									<div class="panel panel-widget forms-panel">
										<div class="forms">
											<div class="form-grids widget-shadow" data-example-id="basic-forms"> 
												<div class="form-title">
													<h4>Profil administrateur :</h4>
												</div>
												<div class="form-body">
													<?php
													$sql="SELECT * from  admin";
													$query = $dbh -> prepare($sql);
													$query->execute();
													$results=$query->fetchAll(PDO::FETCH_OBJ);
													$cnt=1;
													if($query->rowCount() > 0)
													{
														foreach($results as $row)
														{               ?>
															<form method="post">
																<div class="form-group"> <label for="exampleInputEmail1">Nom de l'admin</label> <input type="text" class="form-control"  name="adminname" value="<?php  echo $row->AdminName;?>" required='true'> </div> 
																<div class="form-group"> <label for="exampleInputEmail1">Nom d'utilisateur</label> <input type="text" class="form-control" name="username" value="<?php  echo $row->UserName;?>" readonly="true"> </div>
																<div class="form-group"> <label for="exampleInputEmail1">E-mail</label> <input type="email" class="form-control" name="email" value="<?php  echo $row->Email;?>" required='true'> </div>
																<div class="form-group"> <label for="exampleInputEmail1">Numéro de contact</label> <input type="text" class="form-control" name="mobilenumber" value="<?php  echo $row->MobileNumber;?>" required='true' maxlength='10'> </div>
																<div class="form-group"> <label for="exampleInputEmail1">Date d'inscription de l'administrateur</label> <input type="text" class="form-control" id="email2" name="" value="<?php  echo $row->AdminRegdate;?>" readonly="true"> </div>
																<?php $cnt=$cnt+1;
														}
													} ?>
																<button type="submit" class="btn btn-default" name="submit">Soumettre</button> 
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