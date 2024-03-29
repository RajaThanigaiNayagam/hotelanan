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
        <div class="header">
            <div class="container">
                <?php include_once('includephp/header.php');?>
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

        <!--footer-->
        <?php include_once('includephp/footer.php');?>

        <!--JavaScript Bundle with Popper -->
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    </body>
</html>