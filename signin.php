<?php
    session_start();      //demarrage du session d'un utilisateur admin/clinet 
    error_reporting(0);   //Désactiver tous les rapports d'erreurs

    //  apper le fichier  includephp/connectiondb.php
    include('includephp/connectionbd.php');

	if(isset($_POST['login'])) 		 	//Verification de l'éxistance de l'email at pwd dans le basse de données
	{
		$email=$_POST['email'];
		$password=md5($_POST['password']);
		$sql ="SELECT ID FROM user WHERE Email=:email and Password=:password";
		$query=$dbh->prepare($sql);
		$query->bindParam(':email',$email,PDO::PARAM_STR);
		$query-> bindParam(':password', $password, PDO::PARAM_STR);
		$query-> execute();
		$results=$query->fetchAll(PDO::FETCH_OBJ);
		if($query->rowCount() > 0)
		{
			foreach ($results as $result) {
				$_SESSION['hotelanan']=$result->ID;
			}
			$_SESSION['login']=$_POST['email'];
			echo "<script type='text/javascript'> document.location ='index.php'; </script>";
		} else{
			echo "<script>alert('Les details sont pas correct');</script>";
		}
	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Hotel ANAN - Systéme de réservation | Hotel :: Page de connection</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="HOTEL ANAN Réservation chambres - Rooms booking">
	<meta name="author" content="RAJA Thanigai Nayagam">

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
	<!--header-->
	<div class="header head-top">
		<div class="container">
			<?php include_once('includephp/header.php');?>
		</div>
	</div>
	<!--header-->

	<!-- ------------------------Formulaire de signin page------------------------>
	<div class="content">
		<div class="contact">
			<div class="container">
				<h2>Si vous avez un compte avec nous se connectez S.V.P</h2>
				<div class="contact-grids">
					<div class="col-md-6 contact-right">
						<form method="post">
							<h5>Adresse e-mail</h5>
							<input type="email" class="form-control" value="" name="email" required="true">
							<h5>Mot de passe</h5>
							<input type="password" value="" class="form-control" name="password" required="true">
							<br />
							<a href="forgot-password.php">Mot de passe oublié?</a>
							<br/>
							<input type="submit" value="Connexion" name="login">
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
