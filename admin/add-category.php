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
		$cname=$_POST['cname'];
		$catdes=$_POST['catdes'];
		$price=$_POST['price'];

		$sql="insert into roomcategory(CategoryName,Description,Price)values(:cname,:catdes,:price)";
		$query=$dbh->prepare($sql);
		$query->bindParam(':cname',$cname,PDO::PARAM_STR);
		$query->bindParam(':catdes',$catdes,PDO::PARAM_STR);
		$query->bindParam(':price',$price,PDO::PARAM_STR);
		$query->execute();

		$LastInsertId=$dbh->lastInsertId();
		if ($LastInsertId>0) {
			echo '<script>alert("Category has been added.")</script>';
			echo "<script>window.location.href ='add-category.php'</script>";
		}else{
			echo '<script>alert("Something Went Wrong. Please try again")</script>';
		}
	}?>
	<!DOCTYPE HTML>
	<html>
		<head>
			<title>Hotel Booking Management System | Ajouter une catégorie de chambre</title>
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
			<!-- -------------------------APPEL BOOTSTRAP-------------------------------- -->
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
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
										<h2>Ajouter une Catégorie de chambre</h2>
									</div>
									<div class="panel panel-widget forms-panel">
										<div class="forms">
											<div class="form-grids widget-shadow" data-example-id="basic-forms"> 
												<div class="form-title">
													<h4>Ajouter une catégorie de chambre</h4>
												</div>
												<div class="form-body">
													<form method="post">
														<div class="form-group"> <label for="exampleInputEmail1">Titre de la catégorie de chambre</label> <input type="text" class="form-control" name="cname" value="" required='true'> </div> 
														<div class="form-group"> <label for="exampleInputEmail1">Déscription</label> <textarea type="text" class="form-control" name="catdes" value=""></textarea> </div>
														<div class="form-group"> <label for="exampleInputEmail1">Prix</label> <input type="text" class="form-control" name="price" value="" required='true'> </div>
														<button type="submit" class="btn btn-default" name="submit">Ajouter</button> 
													</form> 
												</div>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
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