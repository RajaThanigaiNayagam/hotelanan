<?php

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
</head>
    <body>
        <div>
            <?php
            $ret="SELECT * from admin";
            $query1 = $dbh -> prepare($ret);
            $query1->execute();
            $result=$query1->fetchAll(PDO::FETCH_OBJ);?>
            foreach($result as $rows)
            {               ?>
                <div><a class="dropdown-item" href="category-details.php?catid=<?php echo htmlentities($rows->ID)?>"></a><?php echo le num de mobile est - htmlentities($rows->MobileNumber)br> Nom de l'Administrateur est  -  <?php echo htmlentities($rows->AdminName) ?></div>
            <?php } ?>
        </div>
    </body>
</html>