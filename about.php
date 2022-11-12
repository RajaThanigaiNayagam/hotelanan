<?php
session_start();      //demarrage du session d'un utilisateur admin/clinet 
error_reporting(0);   //Désactiver tous les rapports d'erreurs

//  apper le fichier  includephp/connectiondb.php
include('includephp/connectionbd.php');
?>
<!DOCTYPE HTML>
<html>
	<head>
	<title>Hotel ANAN - Systéme de réservation | About Us :: Page</title>
	<!-- -------------------------appel POLICE RANCHO------------------------------ -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rancho&display=swap" rel="stylesheet">*
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
			<div class="about-section">
			<div class="container">
				<?php
					$sql="SELECT * from pageutil where PageType='aboutus'";
					$query = $dbh -> prepare($sql);
					$query->execute();
					$results=$query->fetchAll(PDO::FETCH_OBJ);

					$cnt=1;
					if($query->rowCount() > 0)
					{
						foreach($results as $row)
						{               ?>
							<h2><?php  echo htmlentities($row->PageTitle);?></h2>
							<img src="images/p1.jpg" class="img-responsive" alt="/">
							<h5><?php  echo htmlentities($row->PageTitle);?></h5>
							<p><?php  echo htmlentities($row->PageDescription);?>.</p>
							<?php $cnt=$cnt+1;
						}
					} 
				?>
			</div>
		</div>
		<!--about-->
	</div>
	<?php include_once('includes/footer.php');?>
</body>
</html>
