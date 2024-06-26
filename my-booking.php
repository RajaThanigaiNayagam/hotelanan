<?php
	session_start();      //demarrage du session d'un utilisateur admin/clinet 
	error_reporting(0);   //Désactiver tous les rapports d'erreurs

	//  appeler le fichier  includephp/connectiondb.php
	include('includephp/connectionbd.php');

	if (strlen($_SESSION['hotelanan']==0)) {
	header('location:logout.php');
	} else{
		?>
		<!DOCTYPE HTML>
		<html>
		<head>
			<title>Hôtel ANAN - Systéme de réservation | Hôtel :: My Booking</title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta name="description" content="HÔTEL ANAN Réservation chambres - Rooms booking">
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

				<!-- typography -->
			<div class="typography">
					<!-- container-wrap -->
					<div class="container">
						<div class="typography-info">
							<h2 class="type">Détails de ma réservation d'hôtel</h2>
						</div>
						
						<div class="bs-docs-example">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th style="text-align: center;">#</th>
										<th>Numéro de réservation</th>
										<th style="text-align: center;">Nom</th>
										<th>Numéro de portable</th>
										<th style="text-align: center;">Adress Email</th>
										<th style="text-align: center;">Status</th>
										<th style="text-align: center;">Action</th>
										<th style="text-align: center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$uid= $_SESSION['hotelanan'];
										$sql="SELECT user.*,booking.BookingNumber,booking.Status,booking.ID as bid from booking join user on booking.UserID=user.ID where UserID=:uid";

										$query = $dbh -> prepare($sql);
										$query-> bindParam(':uid', $uid, PDO::PARAM_STR);
										$query->execute();
										$results=$query->fetchAll(PDO::FETCH_OBJ);

										$cnt=1;
										if($query->rowCount() > 0)
										{
											foreach($results as $row)
											{               ?>
												<tr>
													<td><?php echo htmlentities($cnt);?></td>
													<td><?php  echo htmlentities($row->BookingNumber);?></td>
													<td><?php  echo htmlentities($row->FullName);?></td>
													<td><?php  echo htmlentities($row->MobileNumber);?></td>
													<td><?php  echo htmlentities($row->Email);?></td>
													<?php if($row->Status=="")
													{ ?>
														<td style="text-align: center;"><?php echo "Toujours en attente"; ?></td>
													<?php } else { ?> 
									                 	<td style="text-align: center;"><?php  echo htmlentities($row->Status);?></td>
													<?php } ?>
													<?php if($row->Status=="approuvée") { ?>
														<td style="text-align: center;"><a href="view-application-detail.php?viewid=<?php echo htmlentities ($row->bid);?>" class="btn btn-primary">Voir les détails</a></td>
													<?php } else { ?> 
									                 	<td style="text-align: center;"><?php  echo "Toujours en attente";?></td>
													<?php } ?>
													<td style="text-align: center;"><a href="delete.php?delete=deletebooking&deletebookingid=<?php echo htmlentities ($row->bid);?>" onclick="return confirm('Etes-vous sûr que vous voulez supprimer?')" class="btn btn-danger">Supprimer</a></td>
												</tr>
												<?php $cnt=$cnt+1;
											}
										} 
									?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- //container-wrap -->
				</div>
				<!-- //typography -->
			</div>
			<!--footer-->
			<?php include_once('includephp/footer.php');?>
			<!--JavaScript Bundle with Popper -->
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
		</body>
		</html>
	<?php }  
?>
