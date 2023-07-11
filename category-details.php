<?php
session_start();      //demarrage du session d'un utilisateur admin/clinet 
error_reporting(0);   //Désactiver tous les rapports d'erreurs

//  apper le fichier  includephp/connectiondb.php
include('includephp/connectionbd.php');

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Hôtel ANAN - Systéme de réservation  | Hôtel :: Détails de la chambre </title>
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
		<!--rooms-->
		<div class="content">
			<div class="room-section">
				<div class="container">
				<h2>Détails de la chambre</h2>
					<div class="room-grids">
						<?php
							$cid=intval($_GET['catid']); 
							// SQL to recupere detail de chambre form the table "romm,  roomcategory" pour son categorie est $cid
							$sql="SELECT room.*,room.id as rmid , roomcategory.Price,roomcategory.ID,roomcategory.CategoryName from room 
							join roomcategory on room.RoomType=roomcategory.ID 
							where room.RoomType=:cid";
							//$sql="SELECT roomcategory.Price,roomcategory.ID,roomcategory.CategoryName from roomcategory 
							//where roomcategory.ID=:cid";
							$query = $dbh -> prepare($sql);
							$query-> bindParam(':cid', $cid, PDO::PARAM_STR);
							$query->execute();
							$results=$query->fetchAll(PDO::FETCH_OBJ);

							$cnt=1;
							if($query->rowCount() > 0)
							{
								foreach($results as $row)
								{               
									?>
									<div class="room1">
										<div class="col-md-5 room-grid" style="padding-bottom: 50px">
											<a href="#" class="mask"><img src="admin/images/<?php echo $row->Image;?>" class="img-fluid mask img-responsive zoom-img" alt="" /></a>
										</div>
										<div class="col-md-7 room-grid1">
											<h4> <?php  echo htmlentities($row->FacilityTitle);?> </h4>
											<p><?php  echo htmlentities($row->RoomDesc);?></p>
											<p>Max Adultes : <?php  echo htmlentities($row->MaxAdult);?></p>
											<p>Max Enfants : <?php  echo htmlentities($row->MaxChild);?></p>
											<p>Lits : <?php  echo htmlentities($row->NoofBed);?></p>
											<p>Équipements de la chambre:<?php  echo htmlentities($row->RoomFacility);?></p>
											<p>Prix : <?php  echo htmlentities($row->Price);?> € </p>
											<button class="reservebutton"><a href="book-room.php?rmid=<?php echo $row->rmid;?>">Réserver cette chambre</a></button><BR>
										</div>
										<div class="clearfix"></div>
									</div><BR><BR><BR>
									<?php $cnt=$cnt+1;
								}
							} 
						?>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		<!--rooms-->
		</div>
		<!--footer-->
		<?php include_once('includephp/footer.php');?>
		<!--JavaScript Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
	</body>
</html>
