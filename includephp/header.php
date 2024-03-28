    <!----------------------------------------------------------->
    <!-------------barre de navigation responsive---------------->
    <!----------------------------------------------------------->
    <div class="header-top">
    <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
        <div class="container-fluid">
        <div class="navbar-brand">
            <h3><a href="index.php">Hôtel ANAN</a></h3>
        </div>

        <!----------------------------------------------------------->
        <!-------------barre de navigation responsive---------------->
        <!----------------------------------------------------------->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#ouvremenu">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
            </svg>
        </button>
        <div class="collapse navbar-collapse" id="ouvremenu">
            <ul class="navbar-nav ms-auto mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Acceuil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">A propos de</a>
                </li>
                <li class="nav-item">
                    <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Chambres</span></a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                                $ret="SELECT * from roomcategory"; //-------- Requette sql pour recuperer toutes les enregistrement depuis la table "roomcategory" -------//
                                $query1 = $dbh -> prepare($ret);
                                $query1->execute();
                                $resultss=$query1->fetchAll(PDO::FETCH_OBJ);
                                foreach($resultss as $rows) //-------- to fill the drop down bar with all the category, so that un user can choose a room category that he wants -------//
                                {               ?>
                                    <li><a class="dropdown-item" href="category-details.php?catid=<?php echo htmlentities($rows->ID)?>"><?php echo htmlentities($rows->CategoryName)?></a></li>
                                <?php } ?>
                        </ul>
                    </li>
                </li>
                <li class="nav-item"><a class="nav-link"  href="reservation.php">Réserver</a></li>
                <!--<li class="nav-item"><a class="nav-link"  href="gallery.php">Gallery</a></li>-->
                <li class="nav-item"><a class="nav-link"  href="contact.php">Contact</a></li>
                <!-- ----------Verification si l'utilisateu n est connectée---------- -->
                <?php if (strlen($_SESSION['hotelanan']==0)) 
                {$_SESSION['hotelanan']?>
                    <li class="nav-item"><a class="nav-link" href="admin/login.php">Admin</a></li>
                    <li class="nav-item"><a class="nav-link" href="signup.php">S'inscrire</a></li>
                    <li class="nav-item"><a class="nav-link" href="signin.php">Connexion</a></li>  <?php 
                } ?>
                <?php if (strlen($_SESSION['hotelanan']!=0)) 
                {?>
                    <!-- ----------Si l utilisateu est déja connectée---------- -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown2" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mon compte</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="profile.php">Profil</a></li>
                            <li><a class="dropdown-item" href="my-booking.php">Mes reservations</a></li>
                            <li><a class="dropdown-item" href="change-password.php">Changer le mot de passe</a></li>
                            <li><a class="dropdown-item" href="logout.php">Se déconnecter</a></li>
                        </ul>
                    </li><?php 
                } ?>
            </ul>
        </div>
        </div>
    </nav>
</div>