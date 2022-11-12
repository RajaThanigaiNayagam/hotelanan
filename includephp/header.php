<nav class="navbar navbar-expand-lg" id="navbar">
    <div class="navbar-brand">
        <h1><a href="index.php">Hotel ANAN</a></h1>
    </div>


    <!----------------------------------------------------------->
    <!-------------barre de navigation responsive---------------->
    <!----------------------------------------------------------->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
    data-bs-target="#menu">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
        </svg>
    </button>
    <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav ms-auto mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="#home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#about">About</a>
            </li>
            <li class="nav-item">
                <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Rooms test</span></a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                            $ret="SELECT * from roomcategory";
                            $query1 = $dbh -> prepare($ret);
                            $query1->execute();
                            $resultss=$query1->fetchAll(PDO::FETCH_OBJ);
                            foreach($resultss as $rows)
                            {               ?>
                                <li><a class="dropdown-item" href="category-details.php?catid=<?php echo htmlentities($rows->ID)?>"><?php echo htmlentities($rows->CategoryName)?></a></li>
                            <?php } ?>
                    </ul>
                </li>
            </li>
            <!--<li class="nav-item"><a class="nav-link"  href="gallery.php">Gallery</a></li>-->
            <li class="nav-item"><a class="nav-link"  href="contact.php">Contact</a></li>
            <!-- ----------Si l utilisateu n est connectée---------- -->
            <?php if (strlen($_SESSION['hbmsuid']==0)) 
            {$_SESSION['hbmsuid']?>
                <li class="nav-item"><a class="nav-link" href="admin/login.php">Admin</a></li>
                <li class="nav-item"><a class="nav-link" href="signup.php">Sign Up</a></li>
                <li class="nav-item"><a class="nav-link" href="signin.php">Login</a></li>  <?php 
            } ?>
            <?php if (strlen($_SESSION['hbmsuid']!=0)) 
            {?>
                <!-- ----------Si l utilisateu est déja connectée---------- -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown2" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="my-booking.php">My Booking</a></li>
                        <li><a class="dropdown-item" href="change-password.php">Change Password</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        
                    </ul>
                </li><?php 
            } ?>
        </ul>
    </div>
</nav>