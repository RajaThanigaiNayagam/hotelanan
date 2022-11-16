<?php
    session_start();      //demarrage du session d'un utilisateur admin/clinet 
    error_reporting(0);   //Désactiver tous les rapports d'erreurs

    //  apper le fichier  includephp/connectiondb.php
    include('includephp/connectionbd.php');

    if (strlen($_SESSION['hotelanan']==0)) {
    header('location:logout.php');
    } else{?>
        <!DOCTYPE HTML>
        <html>
            <head>
            <title>Hotel ANAN - Systéme de réservation | Hotel :: View Booking Detail</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script><!-- -------------------------appel POLICE RANCHO------------------------------ -->
            <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
            
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
              </div>
            </div>
            <!--header-->
            
            <!-- typography -->
            <div class="typography">
                <!-- container-wrap -->
                <div class="container">
                    <div class="typography-info">
                        <h2 class="type">My Hotel Booking Detail</h2>
                    </div>
                    <div class="bs-docs-example">
                      <?php
                            $vid=$_GET['viewid'];

                            $sql="SELECT booking.BookingNumber,user.FullName,user.MobileNumber,user.Email,booking.ID as tid,booking.IDType,booking.Gender,booking.Address,booking.CheckinDate,booking.CheckoutDate,booking.BookingDate,booking.Remark,booking.Status,booking.UpdationDate,roomcategory.CategoryName,roomcategory.Description,roomcategory.Price,room.RoomName,room.MaxAdult,room.MaxChild,room.RoomDesc,room.NoofBed,room.Image,room.RoomFacility 
                            from booking 
                            join room on booking.RoomId=room.ID 
                            join roomcategory on roomcategory.ID=room.RoomType 
                            join user on booking.UserID=user.ID  
                            where booking.ID=:vid";
                            $query = $dbh -> prepare($sql);
                            $query-> bindParam(':vid', $vid, PDO::PARAM_STR);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);

                            $cnt=1;
                            if($query->rowCount() > 0)
                            {
                                foreach($results as $row)
                                {               ?>
                                    <table border="1" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                        <tr><th colspan="4" style="color: red;font-weight: bold;text-align: center;font-size: 20px"> Booking Number: <?php echo $row->BookingNumber;?></th></tr>
                                        <tr><th colspan="4" style="color: blue;font-weight: bold;font-size: 15px"> Booking Detail:</th></tr>
                                        <tr>
                                            <th>Customer Name</th>
                                            <td><?php  echo $row->FullName;?></td>
                                            <th>Mobile Number</th>
                                            <td><?php  echo $row->MobileNumber;?></td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td><?php  echo $row->Email;?></td>
                                            <th>ID Type</th>
                                            <td><?php  echo $row->IDType;?></td>
                                        </tr>
                                        <tr>
                                            <th>Gender</th>
                                            <td><?php  echo $row->Gender;?></td>
                                            <th>Address</th>
                                            <td><?php  echo $row->Address;?></td>
                                        </tr>
                                        <tr>
                                            <th>Check in Date</th>
                                            <td><?php  echo $row->CheckinDate;?></td>
                                            <th>Check out Date</th>
                                            <td><?php  echo $row->CheckoutDate;?></td>
                                        </tr>
                                        <tr>
                                            <tr><th colspan="4" style="color: blue;font-weight: bold;font-size: 15px"> Room Detail:</th></tr>
                                            <th>Room Type</th>
                                            <td><?php  echo $row->CategoryName;?></td>
                                            <th>Room Price(perday)</th>
                                            <td>$<?php  echo $row->Price;?></td>
                                        </tr>
                                        <tr>
                                            <th>Room Name</th>
                                            <td><?php  echo $row->RoomName;?></td>
                                            <th>Room Description</th>
                                            <td><?php  echo $row->RoomDesc;?></td>
                                        </tr>
                                        <tr>
                                            <th>Max Adult</th>
                                            <td><?php  echo $row->MaxAdult;?></td>
                                            <th>Max Child</th>
                                            <td><?php  echo $row->MaxChild;?></td>
                                        </tr>
                                        <tr>
                                            <th>No.of Bed</th>
                                            <td><?php  echo $row->NoofBed;?></td>
                                            <th>Room Image</th>
                                            <td><img src="admin/images/<?php echo $row->Image;?>" width="100" height="100" value="<?php  echo $row->Image;?>"></td>
                                        </tr>
                                        <tr>
                                            <th>Room Facility</th>
                                            <td><?php  echo $row->RoomFacility;?></td>
                                            <th>Booking Date</th>
                                            <td><?php  echo $row->BookingDate;?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="4" style="color: blue;font-weight: bold;font-size: 15px"> Admin Remarks:</th>
                                        </tr>
                                        <tr>
                                            <th>Order Final Status</th>
                                            <td> <?php  $status=$row->Status;
                                                if($row->Status=="Approved")
                                                {
                                                  echo "Your Booking has been approved";
                                                }
                                                if($row->Status=="Cancelled")
                                                {
                                                echo "Your Booking has been cancelled";
                                                }
                                                if($row->Status=="")
                                                {
                                                  echo "Not Response Yet";
                                                };?>
                                            </td>
                                            <th >Admin Remark</th>
                                                <?php if($row->Status==""){ ?>
                                                    <td><?php echo "Not Updated Yet"; ?></td>
                                                <?php } else { ?>                  
                                                    <td><?php  echo htmlentities($row->Status);?></td>
                                                <?php } ?>
                                        </tr>
                                        <?php $cnt=$cnt+1;
                                      }
                                  } 
                      ?>
                                    </table> 
                      <a href="invoice.php?invid=<?php echo htmlentities ($row->tid);?>" class="btn btn-success">Invoice</a>
                      </div>
                  </div>
                  <!-- //container-wrap -->
              </div>
              <!-- //typography -->
              <!--footer-->
                <?php include_once('includes/footer.php');?>
            <!--JavaScript Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        </body>
        </html>
    <?php }  
?>
