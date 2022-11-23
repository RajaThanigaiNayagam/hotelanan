<?php
session_start();      //demarrage du session d'un utilisateur admin/clinet 
error_reporting(0);   //Désactiver tous les rapports d'erreurs

//  apper le fichier  includephp/connectiondb.php
include('includephp/connectionbd.php');
if(isset($_POST['submit']))
{
    $email=$_POST['email'];
	$mobile=$_POST['mobile'];
	$newpassword=md5($_POST['newpassword']);
	$sql ="SELECT Email FROM admin WHERE Email=:email and MobileNumber=:mobile";
	$query= $dbh -> prepare($sql);
	$query-> bindParam(':email', $email, PDO::PARAM_STR);
	$query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
	$query-> execute();
	$results = $query -> fetchAll(PDO::FETCH_OBJ);
	if($query -> rowCount() > 0)
	{
		$con="update admin set Password=:newpassword where Email=:email and MobileNumber=:mobile";
		$chngpwd1 = $dbh->prepare($con);
		$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
		$chngpwd1-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
		$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
		$chngpwd1->execute();
		echo "<script>alert('Your Password succesfully changed');</script>";
	}else {
		echo "<script>alert('Email id or Mobile no is invalid');</script>"; 
	}
}?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Hotel ANAN - Systéme de réservation | Mot de passe oublié Page</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script><!-- -------------------------appel POLICE RANCHO------------------------------ -->
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Rancho&display=swap" rel="stylesheet">
		<!--  ------------------------appel fichier style.css----------------------   -->
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
		<!-- -------------------------APPEL BOOTSTRAP-------------------------------- -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	</head>
	<body>
		<p style="padding-top: 20px;padding-left: 20px"><a href="../index.php"><i class="fa fa-home" aria-hidden="true" style="font-size: 30px;padding-right: 10px"></i>Back Home!!!</a></p>
   		<div class="page-container">
   			<!--/content-inner-->
			<div class="left-content" >
				<div class="inner-content" >
					<div class="content">
						<h3 style="color: red;font-family: cursive;">Hotel ANAN - Systéme de réservation</h3>
						<div class="women_main">
							<!-- start content -->
							<div class="registration">
								<div class="registration_left">
									<h2>Please Enter Required info.</h2>
									<div class="registration_form">
										<!-- Form -->
										<form method="post" name="chngpwd" onSubmit="return valid();">
											<div>
												<label>
													<input placeholder="Adresse e-mail" type="email" required="true" name="email" style="border:solid #000 1px;">
												</label>
											</div>
											<div>
												<label>
													<input placeholder="Numéro de portable" type="text" name="mobile" required="true" maxlength="10" pattern="[0-9]+" style="border:solid #000 1px;">
												</label>
											</div>	
											<div>
												<label>
													<input placeholder="Nouveau mot de passe" type="password" name="newpassword" required="true" style="border:solid #000 1px;">
												</label>
											</div>
											<div>
												<label>
													<input placeholder="Confirmez le mot de passe" type="password" name="confirmpassword" required="true" style="border:solid #000 1px;">
												</label>
											</div>				
											<div>
												<input type="submit" value="Réinitialiser" name="submit">
											</div>
											<div class="forget">
												<a href="login.php">S'identifier</a>
											</div>
										</form>
										<!-- /Form -->
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<!-- end content -->
						</div>
					</div>
					<!--content-->
				</div>
			</div>
			<div class="clearfix"></div>	
		</div>
	</body>
</html>