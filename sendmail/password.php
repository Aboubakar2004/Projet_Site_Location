<?php include_once "cookies.php";

require "bd.php";

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
            header("Location: ../sendmail/bdd.php");
            exit();
        }
    }
    echo "<span class='error'> Mail or password isn't correct </span>";
}