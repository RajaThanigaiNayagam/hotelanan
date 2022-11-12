<?php
session_start();      //demarrage du session d'un utilisateur admin/clinet 
error_reporting(0);   //Désactiver tous les rapports d'erreurs

//  apper le fichier  includephp/connectiondb.php
include('includephp/connectionbd.php');

$ret="SELECT * from admin";
$query1 = $dbh -> prepare($ret);
$query1->execute();
$result=$query1->fetchAll(PDO::FETCH_OBJ);

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Hotel ANAN - Booking Management System | Home :: Page</title>

    <!-- -------------------------appel FONT RANCHO------------------------------ -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rancho&display=swap" rel="stylesheet">

    <!--  ------------------------appel fichier style.css----------------------   -->
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />

    <!-- -------------------------APPEL BOOTSTRAP-------------------------------- -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
    <body>
        <div>
            <?php
            $ret="SELECT * from admin";
            $query1 = $dbh -> prepare($ret);
            $query1->execute();
            $result=$query1->fetchAll(PDO::FETCH_OBJ);?>
            <?php
            foreach($result as $rows)
            {               ?>
                <div><a class="dropdown-item" href="category-details.php?catid=<?php echo htmlentities($rows->ID)?>"></a>le num de mobile est - <?php echo htmlentities($rows->MobileNumber)?><br> Nom de l Administrateur est  -  <?php echo htmlentities($rows->AdminName) ?></div>
            <?php } ?>
        </div> 

        <!--header-->
        <div class="header">
            <div class="container">
                <?php include_once('includephp/header.php');?>
            </div>
        </div>
        <!--header-->

            
        <!--footer-->
        <?php include_once('includephp/footer.php');?>

        <!--JavaScript Bundle with Popper -->
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    </body>
</html>