<?php
session_start();      //demarrage du session d'un utilisateur admin/clinet 
error_reporting(0);   //Désactiver tous les rapports d'erreurs

//  apper le fichier  includephp/connectiondb.php
include('includephp/connectionbd.php');
if (strlen($_SESSION['hotelanan']==0)) {
    header('location:logout.php');
} else{
    $delete=$_GET['delete'];
    $deletebookingid=$_GET['deletebookingid'];
    $deleteroombookingid=$_GET['deleteroombookingid'];
    //echo '<script>alert("The delete message is   "+"'.$delete.'"+"    Delete id is   "+"'.$deletebookingid.'"+" ")</script>';
    if( ($delete == 'deletebooking') and isset($deletebookingid) ){  //Suppression d'une reservation. Nous devons donc supprimer toutes les chambres de la réservation
        $DeleteRoomSQL = "DELETE FROM roombooking WHERE BookingID=:bookingid";
        $DeleteRoomQuery = $dbh -> prepare($DeleteRoomSQL);
        $DeleteRoomQuery-> bindParam(':bookingid', $deletebookingid, PDO::PARAM_INT);
        if ( $DeleteRoomQuery->execute() )  {
            echo '<script>alert("1 Votre numéro de réservation  "+"'.$deletebookingid.'"+"  a été supprimé")</script>';
            $DeleteBookingSQL = "DELETE FROM booking WHERE ID=:bookingid";
            $DeleteBookingSQL = $dbh -> prepare($DeleteBookingSQL);
            $DeleteBookingSQL-> bindParam(':bookingid', $deletebookingid, PDO::PARAM_INT);
            if ( $DeleteBookingSQL->execute() )  {
                echo '<script>alert("2 Votre numéro de réservation  "+"'.$deletebookingid.'"+"  a été supprimé")</script>';
                //header("location:" . $_SERVER['HTTP_REFERER']);
            }
        } else {
                echo '<script>alert("Aucune réservation n\'a été supprimée")</script>';
                //header("location:" . $_SERVER['HTTP_REFERER']);
        }
                        
    } elseif (  ( $delete == 'deleteroombooking') and isset($deleteroombookingid) ) {
        //  
        $OneRoomOfroombookingSQL="SELECT ID, BookingID from roombooking where BookingID=(SELECT BookingID from roombooking where ID=:deleteroombookingid)";
        $OneRoomOfroombookingQuery = $dbh->prepare($OneRoomOfroombookingSQL);
        $OneRoomOfroombookingQuery->bindParam(':deleteroombookingid', $deleteroombookingid, PDO::PARAM_STR);
        $OneRoomOfroombookingQuery->execute();
        $resultOneRoomOfroombookingQuery=$OneRoomOfroombookingQuery->fetchAll(PDO::FETCH_OBJ);
        if(sizeof($resultOneRoomOfroombookingQuery) > 0){  //Nous devons supprimer toutes les chambres de la réservation
            /**echo '<script>alert("1.2 The nb of rooms in the booking is a été supprimé")</script>';
            if ( sizeof($resultOneRoomOfroombookingQuery) == 1)  {
                foreach ($resultOneRoomOfroombookingQuery as $OneRoomOfroombooking){
                    var_dump($OneRoomOfroombooking->BookingID);
                }
            }*/
            $DeleteRoomSQL = "DELETE FROM roombooking WHERE ID=:bookingid";
            $DeleteRoomQuery = $dbh -> prepare($DeleteRoomSQL);
            $DeleteRoomQuery-> bindParam(':bookingid', $deleteroombookingid, PDO::PARAM_INT);
            $DeleteRoomQuery->execute();
            if ( sizeof($resultOneRoomOfroombookingQuery) == 1 )  {
                foreach ($resultOneRoomOfroombookingQuery as $OneRoomOfroombooking){
                    $DeleteBookingSQL = "DELETE FROM booking WHERE ID=:bookingid";
                    $DeleteBookingQuery = $dbh->prepare($DeleteBookingSQL);
                    $DeleteBookingQuery->bindParam(':bookingid', $OneRoomOfroombooking->BookingID, PDO::PARAM_INT);
                    if ( $DeleteBookingQuery->execute() )  {
                        echo '<script>alert("4 Votre numéro de réservation  "+"'.$OneRoomOfroombooking->BookingID.'"+"  a été supprimé")</script>';
                    }                
                }
            }
        } else {
            //echo '<script>alert("Votre numéro de réservation  "+"'.$OneRoomOfroombooking->BookingID.'"+"  a été supprimé")</script>';
        }                    
    }
    header("location:" . $_SERVER['HTTP_REFERER']);
}
header("location:" . $_SERVER['HTTP_REFERER']);
?>
