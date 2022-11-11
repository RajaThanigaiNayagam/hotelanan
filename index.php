<?php

//  apper le fichier  includephp/connectiondb.php
include('includephp/connectionbd.php');

$ret="SELECT * from tblcategory";
$query1 = $dbh -> prepare($ret);
$query1->execute();
$resultss=$query1->fetchAll(PDO::FETCH_OBJ);

?>
<!DOCTYPE HTML>
<html>
<head>
</head>
    <body>
        <div class="header">
            Nom de l'Administrateur est  -  <?php echo htmlentities($rows->ID)?>;
        </div>">
    </body>
</html>