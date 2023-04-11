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
			$uid=$_SESSION['hotelanan'];
			$cpassword=md5($_POST['currentpassword']);
			$newpassword=md5($_POST['newpassword']);
			$sql ="SELECT ID FROM user WHERE ID=:uid and Password=:cpassword";
			$query= $dbh -> prepare($sql);
			$query-> bindParam(':uid', $uid, PDO::PARAM_STR);
			$query-> bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
			$query-> execute();
			$results = $query -> fetchAll(PDO::FETCH_OBJ);

			if($query -> rowCount() > 0)
			{
				$con="update user set Password=:newpassword where ID=:uid";
				$chngpwd1 = $dbh->prepare($con);
				$chngpwd1-> bindParam(':uid', $uid, PDO::PARAM_STR);
				$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
				$chngpwd1->execute();

				echo '<script>alert("Your password successully changed")</script>';
			} else {
				echo '<script>alert("Your current password is wrong")</script>';
			}
		}  ?>
		<!DOCTYPE HTML>
		<html>
		<head>
			<title>Hotel ANAN - Systéme de réservation | Hotel :: Change Password</title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta name="description" content="HÔTEL ANAN Réservation chambres - Rooms booking">
			<meta name="author" content="RAJA Thanigai Nayagam">
					
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script><!-- -------------------------appel POLICE RANCHO------------------------------ -->
			<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
			<script>
				function checkpass()
				{
					if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
					{
						alert('Les champs Nouveau mot de passe et Confirmer le mot de passe ne correspondent pas');
						document.changepassword.confirmpassword.focus();
						return false;
					}
						return true;
				}   
			</script>
				
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
						<h2>Changement mot de passe !!!!!!</h2>
						<div class="contact-grids">
							<div class="col-md-6 contact-right">
								<form method="post" onsubmit="return checkpass();" name="changepassword">
									<h5>Current Password</h5>
									<input type="password" class="form-control" style="font-size: 20px" required="true" name="currentpassword">
									<h5>New Password</h5>
									<input type="password" class="form-control"  required="true" name="newpassword" style="font-size: 20px">
									<h5>Confirm Password</h5>
									<input type="password" class="form-control"  required="true" name="confirmpassword" style="font-size: 20px" ><br /><br/>
									<input type="submit" value="Change" name="submit">
								</form>
							</div>
							<div class="col-md-6 contact-right">
								<img src="images/img.jpg" width="400" height="400" />
							</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
		<?php include_once('includephp/footer.php');?>
		<!--JavaScript Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
	
	</html>
<?php }  ?>
