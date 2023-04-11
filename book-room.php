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
		$booknum=mt_rand(100000000, 999999999);// pour généré un num de réservation entre 100 million et 1 milliard - 1 9 chiffre
		$rid=intval($_GET['rmid']);
		$uid=$_SESSION['hotelanan'];
		$idtype=$_POST['idtype'];
		$gender=$_POST['gender'];
		$address=$_POST['address'];
		$checkindate=$_POST['checkindate'];
		$checkoutdate=$_POST['checkoutdate'];
		//echo '<script>alert("test1 svp...")</script>';
		$cdate=date('Y-m-d');
		if($checkindate <  $cdate){
			echo '<script>alert("La date d\'arrivée doit être supérieure à la date actuelle")</script>';
		} else if($checkindate > $checkoutdate){
			echo '<script>alert("La date de départ doit être égale ou supérieure à la date d\'arrivée")</script>';	
		} else {
			$sql="insert into booking(RoomId,BookingNumber,UserID,IDType,Gender,Address,CheckinDate,CheckoutDate)values(:rid,:booknum,:uid,:idtype,:gender,:address,:checkindate,:checkoutdate)";
			$query=$dbh->prepare($sql);
			$query->bindParam(':rid',$rid,PDO::PARAM_STR);
			$query->bindParam(':booknum',$booknum,PDO::PARAM_STR);
			$query->bindParam(':uid',$uid,PDO::PARAM_STR);
			$query->bindParam(':idtype',$idtype,PDO::PARAM_STR);
			$query->bindParam(':gender',$gender,PDO::PARAM_STR);
			$query->bindParam(':address',$address,PDO::PARAM_STR);
			$query->bindParam(':checkindate',$checkindate,PDO::PARAM_STR);
			$query->bindParam(':checkoutdate',$checkoutdate,PDO::PARAM_STR);
			$query->execute();
   			$LastInsertId=$dbh->lastInsertId();
   			if ($LastInsertId>0) {
   				echo '<script>alert("Votre chambre a été réservée avec succès. Le numéro de réservation est "+"'.$booknum.'")</script>';
				echo "<script>window.location.href ='index.php'</script>";
  			}  else    {
         		echo '<script>alert("Quelque chose a mal tourné. Veuillez réessayer plus tard svp...")</script>';
    		}
  		}
	}    ?>
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
						<h2>Réservez votre chambre</h2>
						<div class="contact-grids">
							<div class="col-md-6 contact-right">
								<form method="post">
									<?php
										$uid=$_SESSION['hotelanan'];
										$sql="SELECT * from user where ID=:uid";
										$query = $dbh -> prepare($sql);
										$query->bindParam(':uid',$uid,PDO::PARAM_STR);
										$query->execute();
										$results=$query->fetchAll(PDO::FETCH_OBJ);
										$cnt=1;
										if($query->rowCount() > 0)
										{
											foreach($results as $row)
											{               ?>
												<h5>Nom</h5>
												<input type="text"  value="<?php  echo $row->FullName;?>" name="name" class="form-control" required="true" readonly="true">
												<h5>Numéro de portable</h5>
												<input type="text" name="phone" class="form-control" required="true" maxlength="10" pattern="[0-9]+" value="<?php  echo $row->MobileNumber;?>" readonly="true">
												<h5>Adresse e-mail</h5>
												<input  type="email" value="<?php  echo $row->Email;?>" class="form-control" name="email" required="true" readonly="true"><?php $cnt=$cnt+1;
											}
										} ?>
									<h5>Type d'identification</h5>
									<select  type="text" value="" class="form-control" name="idtype" required="true" class="form-control">
										<option value="">Choisissez le type d'identification</option>
										<option value="Voter Card">carte d'électeur</option>
										<option value="Adhar Card">carte d'identité</option>
										<option value="Driving Licence Card">Permis de conduire</option>
										<option value="Passport">Passport</option>
									</select>
									<h5>Le genre</h5>
									<p style="text-align: left;"> <input type="radio"  name="gender" id="gender" value="Female" checked="true">féminin</p>
									<p style="text-align: left;"> <input type="radio" name="gender" id="gender" value="Male">masculin</p>
									<h5>Adresse</h5>
									<textarea type="text" rows="10" name="address" required="true"></textarea>
									<h5>Date d'arrivée</h5>
									<input  type="date" value="" class="form-control" name="checkindate" required="true">
									<h5>Date de départ</h5>
									<input  type="date" value="" class="form-control" name="checkoutdate" required="true">
									<input type="submit" value="Envoyer" name="submit">
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
<?php }  ?>
