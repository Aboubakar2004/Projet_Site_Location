<?php require './controller/handle_profil.php' ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/profil.css">
    <title>Document</title>
</head>

<body>
    <section class="header">
        <header>
            <div class="logo">
               <a href="http://localhost/Projet_Site_Location-Aboubakar"><img src="./footer/Consisto-removebg-preview.png" alt="Logo"></a>
            </div>
            <div class="reservations">
                <?php
                if (isset($_SESSION["username"])) {
                    $username = ucfirst($_SESSION["username"]);
                    echo "<a href='../profil_part/'><span class='sign-in'>" . $username . "</span></a>";
                } else {
                    echo "<span class='sign-in'><a href='connexion'>Se connecter</a></span>";
                }
                ?>
            </div>
        </header>
        <div class="menu-items menu-above-video">
            <div class="menu-search "></div>
            <span class="icon">
                <ion-icon class="icn" name="close-outline"></ion-icon>
            </span>
            <?php
            if (isset($_SESSION["username"])) {
                $username = ucfirst($_SESSION["username"]);
                echo "<span class='sign-in'>" . $username . "</span>";
            } else {
                echo "<span class='sign-in'><a href='../subscribiton_part.php/index.php'>Se connecter</a></span>";
            }
            ?>
            <a href=""></a>
        </div>
    </section>
    <section class="profil">
        <div class="reservation">
            <h1>Réservations de l'utilisateur</h1>

            <form action="./index.php" method="post">
                <?php foreach ($reservations as $reservation) : ?>
                    <?php $reservation_annonce_id = $reservation['annonces_id']; ?>
                    <?php $reservation_annonce_image = $reservation['images3']; ?>
                    <?php $reservation_id = $reservation['id'] ?>

                    <?php $reservationQuery = $bdd->prepare("SELECT * FROM annonces WHERE id = :annonce_id");
                    $reservationQuery->bindParam(':annonce_id', $reservation_annonce_id);
                    $reservationQuery->execute();
                    $reservation_annonce = $reservationQuery->fetch(PDO::FETCH_ASSOC); ?>

                    <?php if ($reservation_annonce) : ?>
                        <div class="img">
                            <img src="../annonces_post_part.php/dossier_images/<?php echo $reservation_annonce_image; ?>" alt="">
                            <div class="img_item">
                                <span>20 Rue Beautreillis, Paris 75004</span>
                                <span>Date de réservation: <?php echo $reservation['annonces_date']; ?></span>
                                <span>450$ par nuit</span>
                                <button type="submit" name="remove_btn" value="<?php echo $reservation_id; ?>">Annuler la réservation</button>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </form>
        </div>




        <div class="info">
            <?php foreach ($users as $user) : ?>
                <h1>Informations de l'utilisateur</h1>
                <form class="edit" action="./controller/update_user.php" method="post">
                    <div>
                        <label for="username">Nom d'utilisateur :</label> <br> <br>
                        <div class="edit_item">
                            <input type="text" name="username" value="<?php echo $user['username']; ?>">
                            <button type="submit" name="update_btn"><ion-icon name="create-outline"></ion-icon></button>
                        </div>
                    </div>
                    <div>
                        <label for="mail">Adresse E-mail :</label> <br> <br>
                        <div class="edit_item">
                            <input type="text" name="mail" value="<?php echo $user['mail']; ?>">
                            <button type="submit" name="update_btn"><ion-icon name="create-outline"></ion-icon></button>
                        </div>
                    </div>
                    <div>
                        <label for="birthdate">Date de naissance:</label> <br> <br>
                        <div class="edit_item">
                            <input type="text" name="birthdate" value="<?php echo $user['birthdate']; ?>">
                            <button type="submit" name="update_btn"><ion-icon name="create-outline"></ion-icon></button>
                        </div>
                    </div>
                </form>
                <form class="log_out" action="" method="post">
                    <button name="log_out_button">Se Déconnecter</button>
                </form>
            <?php endforeach; ?>
        </div>

    </section>

    <div class="comment">
        <ul class="comment_item">
            <?php foreach ($commentaires as $commentaire) : ?>
                <ul>
                    <li>
                        <?php echo $commentaire['body']; ?>

                        <?php
                        $annonce_id_commentaire = $commentaire['annonces_id'];

                        $annonce_query = $bdd->prepare("SELECT title FROM annonces WHERE id = :annonce_id");
                        $annonce_query->bindParam(':annonce_id', $annonce_id_commentaire);
                        $annonce_query->execute();
                        $annonce_result = $annonce_query->fetch(PDO::FETCH_ASSOC);

                        if ($annonce_result) {
                            echo $annonce_result['title'];
                        }
                        ?>
                    </li>
                </ul>
            <?php endforeach; ?>
        </ul>
    </div>




    <section class="footer" data-aos="fade-right" data-aos-anchor-placement="center-bottom">
        <footer>
            <ul>
                <h>CONSISTO</h3>
                    <br><br>
                    <li>A propos</li>
                    <br>
                    <li>Carrières</li>
                    <br>
                    <li>Application</li>
                    <br>
                    <li>Media</li>
                    <br>
                    <li>Inspirations</li>
                    <br>
            </ul>
            <ul>
                <h3>CONTACT</h3>
                <br><br>
                <li>Nous contacter</li>
                <br>
                <li>Presse</li>
                <br>
                <li>Devenez partenaire</li>
                <br>
            </ul>
            <ul>
                <h3>TERME ET CONDITIONS</h3>
                <br><br>
                <li>Conditions générales</li>
                <br>
                <li>Mentions légales</li>
                <br>
                <li>Fonctionnalité du site</li>
                <br>
            </ul>
            <ul class="input">
                <h3>ABONNEZ-VOUS A NOTRE NEWSLETTER</h3>
                <br><br>
                <input type="text" placeholder="Email"><br><br>
                <button type="submit">JE M'ABONNE</button>
            </ul>
        </footer>
        <div class="logo">
            <img src="images/Logo.png" alt="">
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
