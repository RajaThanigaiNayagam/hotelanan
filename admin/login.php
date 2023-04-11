<?php
session_start();      //demarrage du session d'un utilisateur admin/clinet 
error_reporting(0);   //Désactiver tous les rapports d'erreurs

//  apper le fichier  includephp/connectiondb.php
include('includephp/connectionbd.php');

if(isset($_POST['login'])) 
{
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $sql ="SELECT ID FROM admin WHERE UserName=:username and Password=:password";
    $query=$dbh->prepare($sql);
    $query-> bindParam(':username', $username, PDO::PARAM_STR);
	$query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
	{
		foreach ($results as $result) {
			$_SESSION['hotelanan']=$result->ID;
		}

		if(!empty($_POST["remember"])) {
			//COOKIES for username  FOR 10 YEARS
			setcookie ("user_login",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
			//COOKIES for password  FOR 10 YEARS
			setcookie ("userpassword",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
		} else {
			if(isset($_COOKIE["user_login"])) {
				setcookie ("user_login","");
				if(isset($_COOKIE["userpassword"])) {
					setcookie ("userpassword","");
				}
			}
		}
		$_SESSION['login']=$_POST['username'];
		echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
	} else{
		echo "<script>alert('Invalid Details');</script>";
	}
}?>
<!DOCTYPE HTML>
<html>
	<head>
	<title>Hôtel ANAN - Systéme de réservation | Page de connexion administrateur</title>
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
		<p style="padding-top: 20px;padding-left: 20px"><a href="../index.php"><i class="fa fa-home" aria-hidden="true" style="font-size: 30px;padding-right: 10px"></i>Retour !!!</a></p>
		<div class="page-container">
			<!--/content-inner-->
			<div class="left-content" >
				<div class="inner-content" >
					<div class="content">
						<h3 style="color: red;font-family: cursive;">Hôtel ANAN - Systéme de réservation</h3>
						<div class="women_main">
							<!-- start content -->
							<div class="registration">
								<div class="registration_left">
									<h2>Veuillez vous connecter</h2>
									<div class="registration_form">
									<!-- Form -->
										<form method="post">
											<div>
												<label><h2>Id de l'admin</h2>
													<input placeholder="Username" type="text" required="true" name="username" style="border:solid #000 1px;" value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>">
												</label>
											</div>
											<div>
												<label><h2>MDP de l'admin</h2>
													<input placeholder="password" type="Password" name="password" required="true" style="border:solid #000 1px;" value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>">
												</label>
											</div>	
											<div class="checkbox checkbox-primary" style="padding-left: 20px">
												<input type="checkbox" id="remember" name="remember"  <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?> />
												<label for="keep_me_logged_in">Se souvenir de moi</label>
											</div>					
											<div>
												<input type="submit" value="Connexion" name="login">
											</div>
											<div class="forget">
												<a href="forgot-password.php">Mot de passe oublié</a>
											</div>
										</form>
										<div class="clearfix"></div>
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
		<!--JavaScript Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
	</body>
</html>