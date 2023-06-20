<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../subscribiton_part.php/style.css">
    <link href="https://fonts.cdnfonts.com/css/audrey" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="logo">
        <img src="../subscribiton_part.php/subsription_part_images.php/Consisto-removebg-preview.png" alt="">
    </div>
    <div class="form_container">
        <div class="form_login">
            <div class="left_side">
                <h3>DÉJÀ INSCRIT(E) ?</h3>
                <p>Si vous êtes déjà inscrit(e) chez blabla, veuillez vous connecter ici :</p>
                <form method="POST">
                    <div class="log_in_input">
                        <input type="text" placeholder="Adresse email *" name="log_in_email">
                        <input type="password" placeholder="Mot de passe *" name="log_in_password">
                        <button class="log_in_button" name="log_in_button">CONNEXION</button>
                    </div>
                </form>
                <p>Votre mot de passe ou votre mail est incorrect</p>
                <p> <a href="./update_password.php"> Vous avez oublié votre mot de passe ?</a></p>
                </p>
            </div>
        </div>
        <div class="form_sign_in">
            <div class="right_side">
                <h3>CRÉEZ VOTRE COMPTE</h3>
                <p>Inscrivez-vous et profitez de nos appartements.</p>
                <div class="sign_in_input">
                    <form action="" class="sign_in_form" method="POST">
                        <input type="text" placeholder="Adresse email *" name="email">
                        <input type="password" placeholder="Mot de passe *" name="password">
                        <input type="text" placeholder="Nom d'utilisateur" name="username">
                        <div class="radio">
                            <label for="homme">Homme</label>
                            <input type="radio" placeholder="" name="gender" value="male">
                            <label for="homme">Femme</label>
                            <input type="radio" placeholder="" name="gender" value="female">
                            <label for="non précisé">Non Précisé</label>
                            <input type="radio" placeholder="" name="gender" value="other">
                        </div>
                        <input type="date" name="birthdate">
                </div>
                <button class="sign_in_button" name="sign_in_ok">S'INSCRIRE</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php
session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=airbnb;charset=utf8', 'root', '');
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

if (isset($_POST["log_in_button"])) {
    $email = $_POST['log_in_email'];
    $password = $_POST['log_in_password'];

    $requete = $bdd->prepare('SELECT * FROM users WHERE mail = :email');
    $requete->execute(["email" => $email]);
    $user = $requete->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user["users_password"])) {
            echo "successfully connected";
            $_SESSION["username"] = $user["username"];
            $_SESSION["user_id"] = $user["id"];
            header("Location: ../reservation_part.php/reservation_page.php?id=" . $_SESSION['annonce_id']);
            exit();
        }
    }
    header("Location: ../reservation_part.php/reservation_password_wrong.php");
}
?>

