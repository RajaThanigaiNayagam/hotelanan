<?php 
session_start();      //demarrage du session d'un utilisateur admin/clinet 
error_reporting(0);   //Désactiver tous les rapports d'erreurs

//  apper le fichier  includephp/connectiondb.php
include('includephp/connectionbd.php');

if(isset($_POST['submit']))		 	//Inserée un nouelle utilisateur email at pwd dans le basse de données
{
    $fname=$_POST['fname'];
    $mobno=$_POST['mobno'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $ret="select Email from tbluser where Email=:email";
    $query= $dbh -> prepare($ret);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> execute();
    $results = $query -> fetchAll(PDO::FETCH_OBJ);

	if($query -> rowCount() == 0)
	{
		$sql="Insert Into user(FullName,MobileNumber,Email,Password)Values(:fname,:mobno,:email,:password)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':fname',$fname,PDO::PARAM_STR);
		$query->bindParam(':email',$email,PDO::PARAM_STR);
		$query->bindParam(':mobno',$mobno,PDO::PARAM_INT);
		$query->bindParam(':password',$password,PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		if($lastInsertId)
		{
			echo "<script>alert('Vous vous êtes inscrit avec succès chez nous');</script>";
		}
		else
		{
			echo "<script>alert('Une erreur s\'est produite. Veuillez réessayer');</script>";
		}
	}
	else
	{
		echo "<script>alert('L\'Email existe déjà. Veuillez réessayer');</script>";
	}
}
?>
<!DOCTYPE HTML>
<html>
	<head>
	<title>Hotel ANAN - Systéme de réservation | Hotel :: Sign Up</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
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

	</head>
	<body>
		<!--header-->
		<div class="header head-top">
			<div class="container">
				<?php include_once('includephp/header.php');?>
			</div>
		</div>
		<!--header-->
		<!--about-->
		<div class="content">
			<div class="contact">
				<div class="container">
					<h2>Inscrivez-vous avec nous</h2>
					<div class="contact-grids">
						<div class="col-md-6 contact-right">
							<form method="post">
								<h5>Nom complet</h5>
								<input type="text" value="" name="fname" required="true" class="form-control">
								<h5>Numéro de mobile</h5>
								<input type="text" name="mobno" class="form-control" required="true" maxlength="10" pattern="[0-9]+">
								<h5>l'Address Email</h5>
								<input type="email" class="form-control" value="" name="email" required="true">
								<h5>Mot de passe</h5>
								<input type="password" value="" class="form-control" name="password" required="true"><br />
								<a href="signin.php" style="color: red">Se connecter</a><br/>
								<input type="submit" value="Sign Up" name="submit">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include_once('includephp/footer.php');?>
		<!--JavaScript Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
	
</html>
