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
        <div class="header">
            Nom de l'Administrateur est  -  <?php echo htmlentities($result->AdminName)
            foreach($result as $rows)
            {               ?>
                <li><a class="dropdown-item" href="category-details.php?catid=<?php echo htmlentities($rows->ID)?>"><?php echo htmlentities($rows->CategoryName)?></a></li>
            <?php } ?>
        </div>
    </body>
</html>