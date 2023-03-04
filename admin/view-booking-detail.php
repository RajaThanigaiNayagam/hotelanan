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
		$bookingid=$_GET['bookingid'];
		$status=$_POST['status'];
		$remark=$_POST['remark'];
		$sql= "update booking set Status=:status,Remark=:remark where BookingNumber=:bookingid";
		$query=$dbh->prepare($sql);
		$query->bindParam(':status',$status,PDO::PARAM_STR);
		$query->bindParam(':remark',$remark,PDO::PARAM_STR);
		$query->bindParam(':bookingid',$bookingid,PDO::PARAM_STR);

		$query->execute();

		echo '<script>alert("Remark has been updated")</script>';
		echo "<script>window.location.href ='new-booking.php'</script>";
	}?>
	<!-- ------------------------ pour afficher la detail d'une réservation ------------------- -->
	<!DOCTYPE HTML>
	<html>
	<head>
		<title>Hôtel ANAN - Systéme de réservation | Afficher la réservation</title>
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
		<div class="page-container">
			<!--/content-inner-->
			<div class="left-content">
				<div class="inner-content">
					<!-- header-starts -->
					<?php include_once('includephp/header.php');?>
					<!--content-->
					<div class="content">
						<div class="women_main">
							<!-- start content -->
							<div class="grids">
								<div class="progressbar-heading grids-heading">
									<h2>Afficher la réservation</h2>
								</div>
								<div class="panel panel-widget forms-panel">
									<div class="forms">
										<div class="form-grids widget-shadow" data-example-id="basic-forms"> 
											<div class="form-title">
												<h4>Afficher la réservation</h4>
											</div>
											<div class="form-body">
												<?php
												$bookid=$_GET['bookingid'];  //**** Récupération id de réservation. Le paramètre 'bookingid' qui vient methode POST OR GET ****
												//**** Requètte SQL qui requpère les info de TABLE  "room", "roomcategory" et "user" pour le "bookingid" donneé ****
												$sql="SELECT booking.BookingNumber,user.FullName,user.MobileNumber,user.Email,booking.IDType,booking.Gender,booking.Address,booking.CheckinDate,booking.CheckoutDate,booking.BookingDate,booking.Remark,booking.Status,booking.UpdationDate,roomcategory.CategoryName,roomcategory.Description,roomcategory.Price,room.RoomName,room.MaxAdult,room.MaxChild,room.RoomDesc,room.NoofBed,room.Image,room.RoomFacility 
												from booking 
												join room on booking.RoomId=room.ID 
												join roomcategory on roomcategory.ID=room.RoomType 
												join user on booking.UserID=user.ID  
												where booking.BookingNumber=:bookid";
												$query = $dbh -> prepare($sql);
												$query-> bindParam(':bookid', $bookid, PDO::PARAM_STR);
												$query->execute();  //**** stoké toutes les enregistrement de resultat de requètte SQL ****
												$results=$query->fetchAll(PDO::FETCH_OBJ);
												$cnt=1;
												if($query->rowCount() > 0)
												{
													foreach($results as $row)
													{               ?>
														<table border="1" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
															<tr>
																<th colspan="4" style="color: red;font-weight: bold;text-align: center;font-size: 20px"> Numéro de réservation: <?php echo $row->BookingNumber;?></th>
															</tr>
															<tr>
																<th colspan="4" style="color: blue;font-weight: bold;font-size: 15px"> Détail de la réservation:</th>
															</tr>
															<tr>
																<th>Nom du client</th>
																<td><?php  echo $row->FullName;?></td>
																<th>Numéro de portable</th>
																<td><?php  echo $row->MobileNumber;?></td>
															</tr>
															<tr>
																<th>E-mail</th>
																<td><?php  echo $row->Email;?></td>
																<th>Type d'identification</th>
																<td><?php  echo $row->IDType;?></td>
															</tr>
															<tr>
																<th>Le genre</th>
																<td><?php  echo $row->Gender;?></td>
																<th>Adresse</th>
																<td><?php  echo $row->Address;?></td>
															</tr>
															<tr>
																<th>Date d'arrivée</th>
																<td><?php  echo $row->CheckinDate;?></td>
																<th>Date de départ</th>
																<td><?php  echo $row->CheckoutDate;?></td>
															</tr>
															<tr>
																<tr>
																	<th colspan="4" style="color: blue;font-weight: bold;font-size: 15px">Détail de la pièce:</th>
																</tr>
																<th>Type de chambre</th>
																<td><?php  echo $row->CategoryName;?></td>
																<th>Prix ​​de la chambre (par jour)</th>
																<td>$<?php  echo $row->Price;?></td>
															</tr>
															<tr>
																<th>Room Name</th>
																<td><?php  echo $row->RoomName;?></td>
																<th>Nom de la chambre</th>
																<td><?php  echo $row->RoomDesc;?></td>
															</tr>
															<tr>
																
																<th>Adulte maximum</th>
																<td><?php  echo $row->MaxAdult;?></td>
																<th>Enfant maximum</th>
																<td><?php  echo $row->MaxChild;?></td>
															</tr>
															<tr>
																
																<th>Nombre de lit</th>
																<td><?php  echo $row->NoofBed;?></td>
																<th>Photos de la chambre</th>
																<td><img src="images/<?php echo $row->Image;?>" width="100" height="100" value="<?php  echo $row->Image;?>"></td>
															</tr>
															<tr>
																<th>Date de réservation</th>
																<td><?php  echo $row->BookingDate;?></td>
															</tr>
															<tr>
																<th colspan="4" style="color: blue;font-weight: bold;font-size: 15px">Remarques de l'administrateur:</th>
															</tr>
															<tr>
																<th>État final de la commande</th>
																<td> <?php  $status=$row->Status;
																	if($row->Status=="Approved")
																	{
																	echo "Your Booking has been approved";
																	}
																	if($row->Status=="Cancelled")
																	{
																	echo "Your Booking has been cancelled";
																	}
																	if($row->Status=="")
																	{
																	echo "Not Response Yet";
																	}
																		;?>
																</td>
																<th>Remarque de l'administrateur</th>
																<?php if($row->Status==""){ ?>
																<td><?php echo "Not Updated Yet"; ?></td>
																<?php } else { ?>                  
																<td><?php  echo htmlentities($row->Status);?></td>
																<?php } ?>
															</tr>
															<?php $cnt=$cnt+1;
														}
													} ?>
												</table> 
												<!--<?//php if ($status==""){?> -->
													<p align="center"  style="padding-top: 20px">                            
													<button class="btn btn-primary waves-effect waves-light w-lg" data-bs-toggle="modal" data-bs-target="#myModal" aria-expanded="false" aria-controls="myModal">modifier le état de la réservation</button></p>  
												<?php //} ?>
												<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLabel">Modifier le état de la réservation</h5>
																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">
																<table class="table table-bordered table-hover data-tables">
																	<form method="post" name="submit">
																		<tr>
																			<th>Remarque :</th>
																			<td><textarea name="remark" placeholder="Remark" rows="12" cols="14" class="form-control wd-450" required="true"></textarea></td>
																		</tr> 
																		<tr>
																			<th>État de la réservation :</th>
																			<td>
																				<select name="status" class="form-control wd-450" required="true" >
																					<option value="approuvée" selected="true">Approuvée</option>
																					<option value="annulée">Annulée</option>
																				</select>
																			</td>
																		</tr>
																</table>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
																<button type="submit" name="submit" class="btn btn-primary">Mise à jour</button>
																</form>
															</div>
															<div class="clearfix"></div>
														</div>
													</div>
												</div>
											</div>
											<!-- end content -->
											<?php include_once('includephp/footer.php');?>
										</div>
									</div>
									<!--content-->
								</div>
							</div>
							<!--//content-inner-->
							<!--/sidebar-menu-->
							<?php include_once('includephp/sidebar.php');?>
							<div class="clearfix"></div>		
						</div>	
					</div>	
				</div>	
			</div>
		</div>
		<!--JavaScript Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
	</body>
	</html>
<?php }  ?>