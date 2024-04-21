<?php
session_start();      //demarrage du session d'un utilisateur admin/clinet 
error_reporting(0);   //Désactiver tous les rapports d'erreurs

//  apper le fichier  includephp/connectiondb.php
include('includephp/connectionbd.php');

if (strlen($_SESSION['hotelanan']==0)) {
      header('location:logout.php');
} else {?>
    <!DOCTYPE HTML>
    <html>
        <head>
            <title>Hôtel ANAN - Systéme de réservation | Hôtel :: View Booking Detail</title>
	        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="HÔTEL ANAN Réservation chambres - Rooms booking">
            <meta name="author" content="RAJA Thanigai Nayagam">

            <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
            <script language="javascript" type="text/javascript">function f2(){window.close();}function f3(){window.print(); }</script>

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
            <div class="header  head-top">
              <div class="container">
                <?php include_once('includephp/header.php');?>
              </div>
            </div>
            <!--header-->

            <!-- typography -->
            <div class="typography">
                <!-- container-wrap -->
                <div class="container">
                    <div class="typography-info">
                        <a href="#" onclick="history.back()"><img SRC="images/backward.png">Retour</a>
                        <h2 class="type">Facture</h2>
                    </div>
                    <p>Détails de ma réservation d'hôtel</p>
                    <div class="bs-docs-example">
                        <?php
                            $invid=$_GET['invid'];
                            /*$sql="SELECT booking.BookingNumber,user.FullName,DATEDIFF(booking.CheckoutDate,booking.CheckinDate) as ddf,user.MobileNumber,user.Email,booking.IDType,booking.Gender,booking.Address,booking.CheckinDate,booking.CheckoutDate,booking.BookingDate,booking.Remark,booking.Status,booking.UpdationDate,roomcategory.CategoryName,roomcategory.Description,roomcategory.Price,room.RoomName,room.MaxAdult,room.MaxChild,room.RoomDesc,room.NoofBed,room.Image,room.RoomFacility 
                            from booking 
                            join roombooking on roombooking.BookingID=booking.ID 
                            join room on roombooking.roomID=room.ID 
                            join roomcategory on roomcategory.ID=room.RoomType 
                            join user on booking.UserID=user.ID  
                            where booking.ID=:invid";//booking.Status='approuvée'*/
                            $sql="SELECT booking.BookingNumber,user.FullName,user.MobileNumber,user.Email,booking.IDType,booking.Gender,booking.Address,booking.CheckinDate,booking.CheckoutDate,booking.BookingDate,booking.Remark,booking.Status,booking.UpdationDate 
                            from booking 
                            join user on booking.UserID=user.ID  
                            where booking.ID=:invid";
                            $query = $dbh -> prepare($sql);
                            $query-> bindParam(':invid', $invid, PDO::PARAM_STR);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $cnt=1;
                            if($query->rowCount() > 0)
                            {
                                foreach($results as $row)
                                {               ?>
                                    <table border="1" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                        <tr><th colspan="5" style="text-align: center;color: red;font-size: 20px">Booking Number: <?php  echo $row->BookingNumber;?></th></tr>
                                        <tr> 
                                            <th>Nom du Client</th><td><?php  echo $row->FullName;?></td>
                                            <th>Numéro de mobile</th><td colspan="2"><?php  echo $row->MobileNumber;?></td>
                                        </tr>
                                        <tr>
                                            <th>Adress mail</th>
                                            <td><?php  echo $row->Email;?></td>
                                            <th>Jour de reservation </th>
                                            <td colspan="2"><?php  echo $row->BookingDate;?></td>
                                        </tr>

                                        <?php
                                        $roomcategorySQL="SELECT (DATEDIFF(booking.CheckoutDate,booking.CheckinDate)+1) as ddf,roombooking.Quantity,roomcategory.CategoryName,roomcategory.Description,roomcategory.Price,room.RoomName,room.MaxAdult,room.MaxChild,room.RoomDesc,room.NoofBed,room.Image,room.RoomFacility 
                                        from booking 
                                        join roombooking on booking.ID=roombooking.BookingID
                                        join room on roombooking.roomID=room.ID 
                                        join roomcategory on roomcategory.ID=room.RoomType 
                                        where roombooking.BookingID=:vid";
                                        $roomcategoryquery = $dbh -> prepare($roomcategorySQL);
                                        $roomcategoryquery-> bindParam(':vid', $invid, PDO::PARAM_STR);
                                        $roomcategoryquery->execute();
                                        $roomcategoryresults=$roomcategoryquery->fetchAll(PDO::FETCH_OBJ);
                                        if($roomcategoryquery->rowCount() > 0)
                                        {?> 
                                            <table border="1" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                                <tr><th colspan="5" style="text-align: center;color: red;font-size: 20px">Detail de la facture</th></tr>
                                                
                                                <tr>
                                                    <th style="text-align: center;">Type de chambre</th>
                                                    <th style="text-align: center;">Prix parjour</th>
                                                    <th style="text-align: center;">Nombre des jours</th>
                                                    <th style="text-align: center;">Quantité par jour</th>
                                                    <th style="text-align: center;">Prix du chambre</th>
                                                    <th style="text-align: center;">Prix Total</th>
                                                    <!--<td><img src="admin/images/<?php echo $RCBrow->Image;?>" width="100" height="100" value="<?php  echo $row->Image;?>"></td>-->
                                                </tr>
                                                <?php     
                                                foreach($roomcategoryresults as $RCBrow)
                                                {   ?>    
                                                        <tr>
                                                            <td style="text-align: center;"><?php  echo $RCBrow->CategoryName;?></td>
                                                            <td style="text-align: center;"><?php  echo $RCBrow->Price;?></td>
                                                            <td style="text-align: center;"><?php  echo $ddf=$RCBrow->ddf;?></td>
                                                            <td style="text-align: center;"><?php  echo $qty= $RCBrow->Quantity;?></td>
                                                            <td style="text-align: center;"><?php  echo $tp= $RCBrow->Price;?></td>
                                                            <td style="text-align: center;"><?php  echo $total=$ddf*$qty*$tp;?></td>
                                                        </tr>
                                                        <?php 
                                                        $grandtotal+=$total;
                                                } ?>
                                                <tr>
                                                    <td style="text-align: center;"></td>
                                                    <td style="text-align: center;"></td>
                                                    <td style="text-align: center;"></td>
                                                    <td style="text-align: center;"></td>
                                                    <th style="text-align:center;color: blue">Total </th>
                                                    <td style="text-align: center;"><?php  echo $grandtotal;?></td>
                                                </tr>
                                            </table> <?php
                                        }?>
                                    </table><?php
                                }    
                            } ?>
                            <p style="text-align: center;font-size: 20px">
                            <input name="Submit2" type="submit" class="btn btn-success" style="color: red;font-size: 20px" value="Imprimer" onClick="return f3();" style="cursor: pointer;"  /></p>
                    </div>
                </div>
                <!-- //container-wrap -->
            </div>
            <!-- //typography -->
            <!--footer-->
            <?php include_once('includephp/footer.php');?>
	        <!--JavaScript Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        </body>
    </html>
<?php }  ?>