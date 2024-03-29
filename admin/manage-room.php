<?php
session_start();      //demarrage du session d'un utilisateur admin/clinet 
error_reporting(0);   //Désactiver tous les rapports d'erreurs

//  apper le fichier  includephp/connectiondb.php
include('includephp/connectionbd.php');

if (strlen($_SESSION['hotelanan']==0)) {
  	header('location:logout.php');
} else{?>
	<!DOCTYPE HTML>
	<html>
		<head>
		<title>Hôtel ANAN - Systéme de réservation | Modifier les chambres</title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			
			<!-- --------------------------- appel jquery --------------------------------- -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
													<table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
														<thead>
															<tr>
																<th class="text-center">Num. de série</th>
																<th>Nom de la chambre</th>
																<th class="d-none d-sm-table-cell">La description</th>
																<th class="d-none d-sm-table-cell">Image</th>
																<th class="d-none d-sm-table-cell">Date de création</th>
																<th class="d-none d-sm-table-cell" style="width: 15%;">Action</th>
															</tr>
														</thead>
														<tbody>
															<?php
															// ---------initiage pagination-------//
															if (isset($_GET['pageno'])) {
																$pageno = $_GET['pageno'];
															} else {
																$pageno = 1;
															}
															// --------/initiage pagination-------//
															// -------Formula for pagination------//
															$no_of_records_per_page = 5;
															$offset = ($pageno-1) * $no_of_records_per_page;
															// -------/Formula for pagination------//
															$ret = "SELECT ID FROM room";
															$query1 = $dbh -> prepare($ret);
															$query1->execute();
															$results1=$query1->fetchAll(PDO::FETCH_OBJ);
															$total_rows=$query1->rowCount();
															$total_pages = ceil($total_rows / $no_of_records_per_page);
															$sql="SELECT * from room LIMIT $offset, $no_of_records_per_page";
															$query = $dbh -> prepare($sql);
															$query->execute();
															$results=$query->fetchAll(PDO::FETCH_OBJ);
															$cnt=$offset+1;
															if($query->rowCount() > 0)
															{
																foreach($results as $row)
																{               ?>
																	<tr>
																		<td class="text-center"><?php echo htmlentities($cnt);?></td>
																		<td class="font-w600"><?php  echo htmlentities($row->RoomName);?></td>
																		<td class="d-none d-sm-table-cell"><?php  echo htmlentities($row->RoomDesc);?></td>
																		<td class="d-none d-sm-table-cell"><img src="images/<?php echo $row->Image;?>" width="100" height="100"></td>
																		<td class="d-none d-sm-table-cell">
																			<span class="badge rounded-pill bg-success"><?php  echo htmlentities($row->CreationDate);?></span>
																		</td>
																		<td class="d-none d-sm-table-cell"><a href="edit-room.php?editid=<?php echo ($row->ID);?>">Éditer</a></td>
																	</tr>
																	<?php $cnt=$cnt+1;
																}
															} ?> 
														</tbody>
													</table>
													<!-- -------Formula for pagination------ -->
													<nav aria-label="Page navigation example">
														<div align="left">
															<ul class="pagination" >
																<li class="page-item"><a class="page-link" href="?pageno=1"><strong>Première page>></strong></a></li>
																<li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
																	<a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><strong style="padding-left: 10px">Précédete></strong></a>
																</li>
																<li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
																	<a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>"><strong style="padding-left: 10px">Suivante></strong></a>
																</li>
																<li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages; ?>"><strong style="padding-left: 10px">Dernière page</strong></a></li>
															</ul>
														</div>
													</nav>
													<!-- ------/Formula for pagination------ -->
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
			</div></div>
			<!--JavaScript Bundle with Popper -->
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
		</body>
	</html>
<?php }  ?>