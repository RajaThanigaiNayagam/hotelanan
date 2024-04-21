<?php
session_start();      //demarrage du session d'un utilisateur admin/clinet 
error_reporting(0);   //Désactiver tous les rapports d'erreurs

//  apper le fichier  includephp/connectiondb.php
include('includephp/connectionbd.php');

//var_dump($_POST);
$cdate=date('Y-m-d');
if (strlen($_SESSION['hotelanan']==0)) {
  	header('location:logout.php');
} else{
 	if(isset($_POST['submit']))
  	{
		$booknum=mt_rand(100000000, 999999999);// pour généré un num de réservation entre 100 million et 1 milliard - 1 9 chiffre
		$rid=intval($_GET['rmid']);
		$uid=$_SESSION['hotelanan'];
		$RoomCategoryID=$_POST['RoomCategoryID'];
		$RoomCategoryNB=$_POST['RoomCategoryNB'];
		$idtype=$_POST['idtype'];
		$gender=$_POST['gender'];
		$address=$_POST['address'];
		$address=$_POST['address'];
		$checkindate=$_POST['checkindate'];
		$checkoutdate=$_POST['checkoutdate'];
		$datechoosed=$_POST['datechoosed'];
		if( ($datechoosed == 'YES') ){
			if($checkindate <  $cdate){
				echo '<script>alert("La date d\'arrivée doit être supérieure à la date actuelle")</script>';
			} else if($checkindate >= $checkoutdate){
				echo '<script>alert("La date de départ doit être supérieure à la date d\'arrivée")</script>';
				//$datechoosed = 'NO';
			} else if( (isset($RoomCategoryNB)) ){
				
				var_dump($RoomCategoryNB);
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
					//var_dump($LastInsertId);
					for ($i = 0; $i < sizeof($RoomCategoryID); $i++) {
						if (  intval($RoomCategoryNB[$i]) > 0){	
							$roombookingcategoryidn=$RoomCategoryID[$i];
							$RoombookingCategorynbr=$RoomCategoryNB[$i];
							$InsertRBSQL="insert into roombooking(BookingID,roomID,Quantity)values(:lastInsertId,:RoomCategoryID,:RoomCategoryNB)";
							$InsertRBquery=$dbh->prepare($InsertRBSQL);
							$InsertRBquery->bindParam(':lastInsertId',$LastInsertId,PDO::PARAM_INT);
							$InsertRBquery->bindParam(':RoomCategoryID',$roombookingcategoryidn,PDO::PARAM_INT);
							$InsertRBquery->bindParam(':RoomCategoryNB',$RoombookingCategorynbr,PDO::PARAM_INT);
							$InsertRBquery->execute();
							//var_dump($InsertRBquery);
							$LastInsId=$dbh->lastInsertId();
							if ($LastInsId>0) {
								echo '<script>alert("Votre chambre a été réservée avec succès. Le numéro de réservation est "+"'.$booknum.'")</script>';
								echo "<script>window.location.href ='index.php'</script>";
							} 
							/**$InsertRBSQL="insert into `roombooking` (`BookingID`,`roomID`,`Quantity`) values ($LastInsertId, $roombookingcategoryidn, $RoombookingCategorynbr);";
							var_dump($InsertRBSQL);
							$InsertRBquery=mysqli_query($conn, $InsertRBSQL) or die(mysqli_error($conn));
							if ($InsertRBquery > 0){
								echo '<script>alert("Votre chambre a été réservée avec succès. Le numéro de réservation est "+"'.$booknum.'")</script>';
									//echo "<script>window.location.href ='index.php'</script>";
							}**/
						}
					}
				}  else    {
					echo '<script>alert("Quelque chose a mal tourné. Veuillez réessayer plus tard svp...")</script>';
				}
			}
		} else {
			echo '<script>alert("veuillez sélectionner la date d\'arrivée et la date de départ svp...")</script>';
		}
	}    ?>
	<!DOCTYPE HTML>
	<html>
		<head>
			<title>Hôtel ANAN - Systéme de réservation | Hôtel :: Réserver la chambre</title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta name="description" content="HÔTEL ANAN Réservation chambres - Rooms booking">
			<meta name="author" content="RAJA Thanigai Nayagam">
					
			<!-- -----------------------Initialisation of jquery--------------------------- -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
					<!-- Cette partie du programme consiste à obtenir la date de réservation auprès de l'utilisateur -->
					<div class="container">
						<h2>Réservez votre chambre</h2>
						<div class="contact-grids">
							<div class="col-md-6 contact-right">
								<form method="post">
									<h5>Date d'arrivée</h5>
									<input  type="date" class="form-control" id="checkindateid" name="checkindate" value="<?php echo $checkindate;?>" min="<?php echo $cdate;?>" required="true">
									<h5>Date de départ</h5>
									<input  type="date" class="form-control" id="checkoutdateid" name="checkoutdate" value="<?php echo $checkoutdate;?>" min="<?php $tomorrow = date("Y-m-d", strtotime("+1 day")); echo $cdate;?>" required="true">
									<input type="hidden" name="datechoosed" value="YES">
									<input type="submit" value="choisis cette date" name="submit">
								</form>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					
					<?php
					if (  ( $datechoosed == 'YES' )  and  ($checkindate <> $checkoutdate)  and  ($checkindate < $checkoutdate)  )  { ?>
						<!--<div style="height:20px;"></div>-->
						<form method="post">
							<div class="col-md-12 text-center" style="text-align:center;">
								<div class="text-center" style="text-align:center;">
									<div style="text-align:center; display: flex; justify-content: center;">
										<!--<table border="1" class="table table-bordered text-center table-striped table-vcenter js-dataTable-full-pagination">-->
										<table border="1" class="table-res table-bordered table-striped table-vcenter">	
											<thead>
												<tr>
													<th>Photo de chambre</th>
													<th>Catégorie de chambre</th>
													<th>Nombre de chambre</th>
													<th>prix unitaire</th>
													<th>prix total</th>
												</tr>
											</thead>
											<tbody>
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
															<!--<h5>Nom</h5>
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
												<textarea type="text" rows="3" name="address" required="true"></textarea>
												-->
												<?php
													$NbRoomsForCategoryCount=0;
													//$ArrayReservationDates=0;
													/** *************************************************************************************** */
													/**                   Pour obtenir toutes les dates de réservation                          */
													/* **************************************************************************************** */
													$period = new DatePeriod(new DateTime($checkindate), new DateInterval('P1D'), new DateTime($checkoutdate));
													foreach ($period as $date) {
														$Reservationdates[] = $date->format("Y-m-d");
													}
													//var_dump($Reservationdates);
													/** *************************************************************************************** */
													$ret="SELECT * from roomcategory"; //-------- Requêtes sql pour recuperer toutes les enregistrement depuis la table "roomcategory" -------// INNER join room on roomcategory.ID=room.RoomType 
													$query1 = $dbh -> prepare($ret);
													$query1->execute();
													$resultss=$query1->fetchAll(PDO::FETCH_OBJ); 
													$roomCategoryCount=sizeof($resultss);
													foreach($resultss as $rows) //-------- to fill the drop down bar with all the category, so that un user can choose a room category that he wants -------//
													{               ?>
														<tr>
                                        					<td class="text-center">  <img src="admin/images/<?php echo $rows->Image;?>" class="reservationimage" width="100" height="70" value="<?php  echo $rows->Image;?>">  </td>
															<td class="text-center">  <?php echo htmlentities($rows->CategoryName)?>  </td>
															<td class="text-center">  <?php
																if($datechoosed == 'YES'){
																	$roomid=$rows->ID;
																	$totRoom = intval($rows->RoomsAvail); 
																	foreach($Reservationdates as $Reservationdate){
																		$ret="SELECT SUM(roombooking.Quantity) as qty from roombooking 
																		join booking on roombooking.BookingID=booking.ID 
																		join room on roombooking.roomID=room.ID 
																		join roomcategory on room.RoomType=roomcategory.ID
																		where room.ID=:roomid and :ReservDate between booking.CheckinDate and ( DATEADD(day,-1,Convert( Date, booking.CheckoutDate ))  )"; //date('Y-m-d', strtotime(booking.CheckoutDate .' -1 day'))"; //-------- Requêtes sql pour recuperer toutes les enregistrement depuis la table "roomcategory" -------//
																		$query1 = $dbh -> prepare($ret);
																		$query1-> bindParam(':roomid', $roomid, PDO::PARAM_STR);
																		$query1-> bindParam(':ReservDate', $Reservationdate, PDO::PARAM_STR);
																		$query1->execute();
																		$replyquery=$query1->fetchAll(PDO::FETCH_OBJ); 
																		//var_dump($replyquery); 
																		foreach($replyquery as $result){   
																			if ( $totRoom > intval($result->qty) ) { $totRoom=$totRoom-intval($result->qty);  }
																			else {  $totRoom=0;  }
																		}
																		if ( $NbRoomsForCategoryCount < $totRoom ) { $NbRoomsForCategoryCount=$totRoom; }
																		$arrayRoomReservation[$Reservationdate][$rows->ID]=$totRoom;
																	}  
																	?>
																	<input type="hidden" name="RoomCategoryID[]" value="<?php echo $rows->ID;?>">
																	<input type="number" id="<?php echo $rows->CategoryName?>" name="RoomCategoryNB[]" value="0" min="0" max="<?php echo htmlentities($NbRoomsForCategoryCount)?>" />
																<?php } else {
																	echo '<script>"veuillez sélectionner la date d\'arrivée et la date de départ svp...";</script>';
																} ?>
															</td>
															<td class="text-center">  <?php echo htmlentities($rows->Price)?>  </td>
															<td class="text-center" id="TotPrice">  </td>
														</tr>
													<?php	$NbRoomsForCategoryCount=0; }; ?>
												<input type="hidden" name="checkindate" value="<?php echo $checkindate;?>">
												<input type="hidden" name="checkoutdate" value="<?php echo $checkoutdate;?>">
												<input type="hidden" name="datechoosed" value="YES">
												<input type="hidden" name="roomCategoryCount" value="<?php echo $roomCategoryCount;?>">
											</tbody>
										</table>
									</div>
									<?php //var_dump($arrayRoomReservation);  ?>
									<div class="reservation"> 	<input type="submit" value="Envoyer" name="submit">  </div>
								</div>
							</div>
						</form>
						<!--<div style="height:20px;"></div>-->
					<?php
					} else {
						//echo '<script>alert("veuillez sélectionner la date d\'arrivée et la date de départ svp...");</script>';
						echo '<script>document.getElementById("checkindateid").focus();</script>'; 
					}  ?>
				</div>
			</div>
			<?php include_once('includephp/footer.php');?>
			<!--JavaScript Bundle with Popper -->
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
		</body>
	</html>
<?php }  ?>
