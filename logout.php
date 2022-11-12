<?php
session_start();        //demarrage du session d'un utilisateur admin/clinet 
session_unset();        //suprime les donnée dans la session
session_destroy();      //detruire la session
header('location:signin.php');

?>