<?php
session_start();      //demarrage du session d'un utilisateur admin/clinet 
error_reporting(0);   //Désactiver tous les rapports d'erreurs

//  apper le fichier  includephp/connectiondb.php
include('includephp/connectionbd.php');

 if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$message=$_POST['message'];

	$sql="insert into contact(Name,MobileNumber,Email,Message)values(:name,:phone,:email,:message)";
	$query=$dbh->prepare($sql);
	$query->bindParam(':name',$name,PDO::PARAM_STR);
	$query->bindParam(':phone',$phone,PDO::PARAM_STR);
	$query->bindParam(':email',$email,PDO::PARAM_STR);
	$query->bindParam(':message',$message,PDO::PARAM_STR);
	$query->execute();

	$LastInsertId=$dbh->lastInsertId();
	if ($LastInsertId>0) {
		echo "<script>alert('Your message was sent successfully!.');</script>";
		echo "<script>window.location.href ='contact.php'</script>";
	}else{
		echo '<script>alert("Something Went Wrong. Please try again")</script>';
	}
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Hotel ANAN - Systéme de réservation | Hotel :: Contact Us</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
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
		<div class="header">
			<div class="container">
				<?php include_once('includephp/header.php');?>
			</div>
		</div>
		<!--header-->
		<!--about-->
		<div class="content">
			<div class="contact">
				<div class="container">
					<h2>Nous contacter</h2>
					<div class="contact-grids">
						<div class="col-md-6 contact-left">
							<?php
								$sql="SELECT * from pageutil where PageType='aboutus'";
								$query = $dbh -> prepare($sql);
								$query->execute();
								$results=$query->fetchAll(PDO::FETCH_OBJ);

								$cnt=1;
								if($query->rowCount() > 0)
								{
									foreach($results as $row)
									{              
										?>
										<p><?php  echo htmlentities($row->PageDescription);?>.</p><?php $cnt=$cnt+1;
									}
								} 
							?>
														
							<?php
								$sql="SELECT * from pageutil where PageType='contactus'";
								$query = $dbh -> prepare($sql);
								$query->execute();
								$results=$query->fetchAll(PDO::FETCH_OBJ);

								$cnt=1;
								if($query->rowCount() > 0)
								{
								foreach($results as $row)
								{               ?>
								<address>
									<p><?php  echo htmlentities($row->PageTitle);?></p>
									<p><?php  echo htmlentities($row->PageDescription);?></p>
									
									<p>Telephone : +<?php  echo htmlentities($row->MobileNumber);?></p>
								
									<p>E-mail : <?php  echo htmlentities($row->Email);?></p>
								</address>
								<?php $cnt=$cnt+1;}} ?>
						</div>
						<div class="col-md-6 contact-right">
							<form method="post">
								<h5>Name</h5>
								<input type="text"  type="text" value="" name="name" required="true">
								<h5>Mobile Number</h5>
								<input type="text" name="phone" required="true" maxlength="10" pattern="[0-9]+">
								<h5>Email Address</h5>
								<input type="text" type="email" value="" name="email" required="true">
								<h5>Message</h5>
									<textarea rows="10" name="message" required="true"></textarea>
									<input type="submit" value="send" name="submit">
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
