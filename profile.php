<?php
session_start();      //demarrage du session d'un utilisateur admin/clinet 
error_reporting(0);   //Désactiver tous les rapports d'erreurs

//  apper le fichier  includephp/connectiondb.php
include('includephp/connectionbd.php');

if (strlen($_SESSION['hotelanan']==0)) {
	header('location:logout.php');
} else 
{
	if(isset($_POST['submit']))
	{
		$uid=$_SESSION['hotelanan'];
		$AName=$_POST['fname'];
		$mobno=$_POST['mobno'];
		$sql="update user set FullName=:name,MobileNumber=:mobilenumber where ID=:uid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':name',$AName,PDO::PARAM_STR);
		$query->bindParam(':mobilenumber',$mobno,PDO::PARAM_STR);
		$query->bindParam(':uid',$uid,PDO::PARAM_STR);
		$query->execute();
		echo '<script>alert("Profile has been updated")</script>';
  	}
  	?>
	<!DOCTYPE HTML>
	<html>
	<head>
		<title>Hotel Booking Management System | Hotel :: Profile utilisateur</title>
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
						
						<h2>View Your Profile !!!!!!</h2>
						
					<div class="contact-grids">
						
							<div class="col-md-6 contact-right">
								<form method="post">
									<?php
										$uid=$_SESSION['hotelanan'];
										$sql="SELECT * from  user where ID=:uid";
										$query = $dbh -> prepare($sql);
										$query->bindParam(':uid',$uid,PDO::PARAM_STR);
										$query->execute();
										$results=$query->fetchAll(PDO::FETCH_OBJ);
										$cnt=1;
										if($query->rowCount() > 0)
										{
											foreach($results as $row)
											{               
												?>
												<h5>Full Name</h5>
												<input type="text" value="<?php  echo $row->FullName;?>" name="fname" required="true" class="form-control">
												<h5>Mobile Number</h5>
												<input type="text" name="mobno" class="form-control" required="true" maxlength="10" pattern="[0-9]+" value="<?php  echo $row->MobileNumber;?>">
												<h5>Email Address</h5>
												<input type="email" class="form-control" value="<?php  echo $row->Email;?>" name="email" required="true" readonly='true'>
												<h5>Registration Date</h5>
												<input type="text" value="<?php  echo $row->RegDate;?>" class="form-control" name="password" readonly="true">
												<br /><?php $cnt=$cnt+1;
											}
										} ?><br/>
										<input type="submit" value="Update" name="submit">
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
