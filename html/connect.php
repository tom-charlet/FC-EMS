<?php
if(isset($_SESSION)){
session_destroy();
}
session_start();
include "../command.php";
$bdd=bdd_connection();

if(isset($_POST["user"])){
    if(isset($_POST["pass"])){
        $pass=hash("sha256",$_POST["pass"]);
        $rep=$bdd->query("select name from staff where name = '".$_POST["user"]."' and password = '".$pass."'")->fetch(PDO::FETCH_ASSOC);
        if(!empty($rep)){
            $_SESSION["connection"]=true;
            $_SESSION["token"]["name"]=$rep["name"];
            $_SESSION["token"]["pass"]=$pass;
            header("Location: ../private/index.php");
        } else {
            echo '<div id="error">Votre identifiant / mot de passe est incorrect</div>';
        }
    } else {
        // manque le mdp (gerer l erreur)
    }
} else {
    // manque le nom dutilisateur (gerer l erreur)
    unset($_POST["pass"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connection</title>
</head>
<body>
    <form action="" method="post">
        <p>
            <label for="user">User</label>
            <input type='text' name='user' id ='user' size='25' pattern='[A-Za-z0-9]{3-20}' required autofocus>
        </p>
        <p>
            <label for="pass">Password</label>
            <input type='text' name='pass' id ='pass' size='25' required>
        </p>
        <input type="submit" value="connect">
    </form>
</body>
</html>