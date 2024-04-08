<?php
    session_start();      //demarrage du session d'un utilisateur admin/clinet 
    error_reporting(0);   //Désactiver tous les rapports d'erreurs
    
    include('includephp/connectionbd.php');   //  apper le fichier  includephp/connectiondb.php
    //------- Réquette SQL pour recupère tout les admin depuis la table "admin"  -------//
    $ret="SELECT * from admin";
    $query1 = $dbh -> prepare($ret);
    $query1->execute();
    $result=$query1->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Hôtel ANAN - Systéme de réservation | Home :: Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="HÔTEL ANAN Réservation chambres - Rooms booking">
	<meta name="author" content="RAJA Thanigai Nayagam">
    
	<!-- --------------------------- appel jquery --------------------------------- -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	
    
	<!-- ------------------------ responsive Flexisel ----------------------------- -->
    <script type="text/javascript" src="js/jquery.flexisel.js"></script>
	<!-- ------------------------ responsive Flexisel ----------------------------- -->

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
		            <div class="slider">
                        <div id="carouselRoomcategoryControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php 
                                    $firstimage = true;
                                    $roomcategorySQL="SELECT * from roomcategory"; //-------- Requêtes sql pour recuperer toutes les enregistrement depuis la table "roomcategory" -------// INNER join room on roomcategory.ID=room.RoomType 
                                    $roomcategoryQuery = $dbh -> prepare($roomcategorySQL);
                                    $roomcategoryQuery->execute();
                                    $roomcategorys=$roomcategoryQuery->fetchAll(PDO::FETCH_OBJ); 
                                    $roomCategoryCount=sizeof($roomcategorys);
                                    foreach($roomcategorys as $roomcategory) //-------- to fill the drop down bar with all the category, so that un user can choose a room category that he wants -------//
                                    {    
                                        if ($firstimage){echo '<div class="carousel-item active">';$firstimage=false;}else{echo '<div class="carousel-item">';} ?>
                                            <img height="250vh" class="d-block w-100" src="admin/images/<?php echo $roomcategory->Image;?>" alt="<?php echo $roomcategory->CategoryName;?>">
                                        </div>   <?php  
                                    }; ?>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselRoomcategoryControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselRoomcategoryControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                    </button>
                            </div>
                        </div>
                    </div>
                <!--
                <section id="salledesport">
                    <div class="row" style ="color : #4a7940; font-weight: bold; opacity: 7.5;">
                        <div class="col-lg-6 col-md-6 col-12 order-1">
                            <h6 class="display-6"><span>Bienvenu dans <br> notre Salle de sport</span> </h1>
                            <p class="my-lg-2 my-3">Améliorez votre parcours de remise en forme au centre de remise en forme ultramoderne de l'Hotel Anan. Notre établissement bien équipé offre une gamme d'équipements et d'équipements d'exercice modernes pour vous aider à rester actif et motivé. Atteignez vos objectifs de mise en forme dans un environnement accueillant qui veille à votre bien-être. Découvrez le centre de remise en forme de l'Anandha Inn pour une séance d'entraînement enrichissante.</p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 py-lg-0 py-3 order-sm-2" style ='display : flex; justify-content : center ; align-items : center ;'>
                            <img src="images/salle de sport.jpg" class="img-fluid"  style ='width : 50%; height : 70% ;' >
                        </div>
                    </div>
                </section> -->
            </div>
        </div>
        <!--header-->
    
    <div class="clearout"></div>
    <!-- slider -->		 
			 <ul id="flexiselDemo1">
				 <li> <a href="index.php"><img src="images/s1.jpg" alt=""/>  </a> </li>
				 <li> <a href="index.php"><img src="images/s2.jpg" alt=""/>  </a> </li>
				 <li> <a href="index.php"><img src="images/s3.jpg" alt=""/>  </a> </li>
				 <li> <a href="index.php"><img src="images/s4.jpg" alt=""/>	 </a> </li>
				 <li> <a href="index.php"><img src="images/s5.jpg" alt=""/>  </a> </li>
				 <li> <a href="index.php"><img src="images/s6.jpg" alt=""/>  </a> </li>
			</ul>
			<script type="text/javascript">
				 $(window).load(function() {			
                    $("#flexiselDemo1").flexisel({
                        visibleItems: 4,
                        animationSpeed: 200,
                        autoPlay: true,
                        autoPlaySpeed: 2000,    		
                        pauseOnHover:true,
                        enableResponsiveBreakpoints: true,
                        responsiveBreakpoints: { 
                            portrait: { 
                                changePoint:480,
                                visibleItems: 1
                            }, 
                            landscape: { 
                                changePoint:640,
                                visibleItems: 2
                            },
                            tablet: { 
                                changePoint:768,
                                visibleItems: 3
                            }
                        }
                    });
				});
            </script>
	<!-- //slider -->

        <!--footer-->
        <?php include_once('includephp/footer.php');?>

        <!--JavaScript Bundle with Popper -->
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    </body>
</html>