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

		$hbmsaid=$_SESSION['hbmsaid'];
		$roomtype=$_POST['roomtype'];
		$roomname=$_POST['roomname'];
		$maxadult=$_POST['maxadult'];
		$maxchild=$_POST['maxchild'];
		$roomfac = implode(',', $_POST['roomfac']);
		$roomdes=$_POST['roomdes'];
		$nobed=$_POST['nobed'];
		$eid=$_GET['editid'];

		$sql="update room set RoomType=:roomtype,RoomName=:roomname,MaxAdult=:maxadult,MaxChild=:maxchild,RoomDesc=:roomdes,NoofBed=:nobed,RoomFacility=:roomfac where ID=:eid";
		$query=$dbh->prepare($sql);
		$query->bindParam(':roomtype',$roomtype,PDO::PARAM_STR);
		$query->bindParam(':roomname',$roomname,PDO::PARAM_STR);
		$query->bindParam(':maxadult',$maxadult,PDO::PARAM_STR);
		$query->bindParam(':maxchild',$maxchild,PDO::PARAM_STR);
		$query->bindParam(':roomdes',$roomdes,PDO::PARAM_STR);
		$query->bindParam(':nobed',$nobed,PDO::PARAM_STR);
		$query->bindParam(':roomfac',$roomfac,PDO::PARAM_STR);
		$query->bindParam(':eid',$eid,PDO::PARAM_STR);
		$query->execute();
		$query->execute();
		echo '<script>alert("Le détail de la chambre a été mis à jour")</script>';
		echo "<script>window.location.href ='manage-room.php'</script>";
	}?>
	<!DOCTYPE HTML>
	<html>
		<head>
			<title>Hôtel ANAN - Systéme de réservation | Modifier les chambres</title>
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
										<h2>Modifier les chambres</h2>
									</div>
									<div class="panel panel-widget forms-panel">
										<div class="forms">
											<div class="form-grids widget-shadow" data-example-id="basic-forms"> 
												<div class="form-title">
													<h4>Modifier les chambres</h4>
												</div>
												<div class="form-body">
													<form method="post" enctype="multipart/form-data">
														<?php
														$eid=$_GET['editid'];
														$sql="SELECT * from  room where ID=$eid";
														$query = $dbh -> prepare($sql);
														$query->execute();
														$results=$query->fetchAll(PDO::FETCH_OBJ);
														$cnt=1;
														if($query->rowCount() > 0)
														{
															foreach($results as $row)
															{               ?>
																<div class="form-group"> <label for="exampleInputEmail1">Type de chambre ou catégorie</label> 
																<select type="text" name="roomtype" id="roomtype" value="" class="form-control" required="true">
																	<option value="<?php  echo $row->RoomType;?>"><?php  echo $row->RoomType;?></option>
																	<?php 
																	$sql2 = "SELECT * from roomcategory";
																	$query2 = $dbh -> prepare($sql2);
																	$query2->execute();
																	$result2=$query2->fetchAll(PDO::FETCH_OBJ);
																	foreach($result2 as $row2)
																	{ ?>
																		<option value="<?php echo htmlentities($row2->ID);?>"><?php echo htmlentities($row2->CategoryName);?></option>
																	<?php } ?> 
				                                                </select> </div>
																<div class="form-group"> <label for="exampleInputEmail1">Room Name</label> <input type="text" class="form-control" name="roomname" value="<?php  echo $row->RoomName;?>" required='true'> </div>
																<div class="form-group"> <label for="exampleInputEmail1">Max Adult</label> <input type="text" class="form-control" name="maxadult" value="<?php  echo $row->MaxAdult;?>" required='true'> </div>
																<div class="form-group"> <label for="exampleInputEmail1">Max Child</label> <input type="text" class="form-control" name="maxchild" value="<?php  echo $row->MaxChild;?>" required='true'> </div>
																<div class="form-group"> <label for="exampleInputEmail1">Room Description</label> <textarea type="text" class="form-control" name="roomdes"><?php  echo $row->RoomDesc;?></textarea> </div>
																<div class="form-group"> <label for="exampleInputEmail1">No. of Bed</label> <input type="text" class="form-control" name="nobed" value="<?php  echo $row->NoofBed;?>" required='true'> </div>
																<div class="form-group"> <label for="exampleInputEmail1">Room Image</label> &nbsp;&nbsp;
																	<img src="images/<?php echo $row->Image;?>" width="100" height="100" value="<?php  echo $row->Image;?>">
																	<a href="changeimage.php?editid=<?php echo $row->ID;?>"><!-- &nbsp; Edit Image--></a>
																</div>									
																<?php $cnt=$cnt+1;
															}
														} ?>
														<button type="submit" class="btn btn-default" name="submit">Update</button> 
													</form> 
													<div class="clearfix"></div>
												</div>
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
			<!--JavaScript Bundle with Popper -->
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
		</body>
	</html>
<?php }  ?>