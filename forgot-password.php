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
	$sql ="SELECT Email FROM user WHERE Email=:email and MobileNumber=:mobile";
	$query= $dbh -> prepare($sql);
	$query-> bindParam(':email', $email, PDO::PARAM_STR);
	$query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
	$query-> execute();
	$results = $query -> fetchAll(PDO::FETCH_OBJ);
	if($query -> rowCount() > 0)
	{
		$con="update user set Password=:newpassword where Email=:email and MobileNumber=:mobile";
		$chngpwd1 = $dbh->prepare($con);
		$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
		$chngpwd1-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
		$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
		$chngpwd1->execute();
		echo "<script>alert('Votre mot de passe a été modifié avec succès');</script>";
		echo "<script>window.location.href ='signin.php'</script>";
	}
	else {
		echo "<script>alert('L'identifiant de messagerie ou le numéro de mobile n'est pas valide');</script>"; 
	}
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Hôtel ANAN - Systéme de réservation | Hôtel :: Réserver la chambre</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="HÔTEL ANAN Réservation chambres - Rooms booking">
		<meta name="author" content="RAJA Thanigai Nayagam">
				
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script><!-- -------------------------appel POLICE RANCHO------------------------------ -->
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		
		<!-- -------------------------appel POLICE RANCHO------------------------------ -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Rancho&display=swap" rel="stylesheet">
		<!--  ------------------------appel fichier style.css----------------------   -->
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
		<!-- -------------------------APPEL BOOTSTRAP-------------------------------- -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	
		<script type="text/javascript">
			function valid()
			{
				if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
				{
					alert("Le champ Nouveau mot de passe et Confirmer le mot de passe ne correspondent pas !!");
					document.chngpwd.confirmpassword.focus();
					return false;
				}
				return true;
			}
		</script>
	</head>
	<body>
		<!--header-->
		<div class="header head-top">
			<div class="container">
				<?php include_once('includes/header.php');?>
			</div>
		</div>
		<!--header-->
		<!--about-->
		<div class="content">
			<div class="contact">
				<div class="container">
					<h2>Réinitialisez votre mot de passe.</h2>
					<div class="contact-grids">
						<div class="col-md-6 contact-right">
							<form method="post" name="chngpwd" onSubmit="return valid();">
								<h5>Adresse e-mail</h5>
								<input type="email" placeholder="Email address" class="form-control" value="" name="email" required="true">
								<h5>Numéro de portable</h5>
								<input type="text" placeholder="Mobile Number" class="form-control" name="mobile" required="true">
								<h5>Nouveau mot de passe</h5>
								<input type="password" placeholder="New Password" name="newpassword" required="true" class="form-control">
								<h5>Confirmez le mot de passe</h5>
								<input type="password" placeholder="Confirm Password" name="confirmpassword" required="true" class="form-control">
								<br />
								<a href="signin.php" style="color: red">S'identifier</a>
								<br/>
								<input type="submit" value="Reset" name="submit">
						 	</form>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
		<?php include_once('includephp/footer.php');?>
		<!--JavaScript Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
	</body>
</html>
