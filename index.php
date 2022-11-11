<?php

//  apper le fichier  includephp/connectiondb.php
include('includephp/connectionbd.php');

$ret="SELECT * from tbladmin";
$query1 = $dbh -> prepare($ret);
$query1->execute();
$result=$query1->fetchAll(PDO::FETCH_OBJ);

?>
<!DOCTYPE HTML>
<html>
<head>
</head>
    <body>
        <div class="header">
            Nom de l'Administrateur est  -  <?php echo htmlentities($result->AdminName)?>
        </div>
    </body>
</html>