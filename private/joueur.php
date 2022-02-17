<?php 
session_start();
if(isset($_SESSION["connection"])&&($_SESSION["connection"]===true)&&(isset($_SESSION["token"]["pass"]))&&(isset($_SESSION["token"]["name"]))){
    include "../command.php";
    $bdd=bdd_connection();
    $rep=$bdd->query("select name,type from staff where password = '".$_SESSION["token"]["pass"]."'")->fetch();
    if($rep["name"]===$_SESSION["token"]["name"]){
        $rep=$bdd->query("select * from staff where name = '".$_SESSION["token"]["name"]."'")->fetch();
    } else {
        session_destroy();
        header("Location: ../html/connect.php");
    }
} else {
    session_destroy();
    header("Location: ../html/connect.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joueur</title>
</head>
<body>
    <h3>Joueur</h3>
    <form id='for' method='post'>
    <?php 
    if(isset($_POST["action"])){$_SESSION["joueur"]["action"]=$_POST["action"];}
    ?>
    <p>
    <button name="action" type="submit" value="add" <?php if(isset($_SESSION["joueur"]["action"])&&$_SESSION["joueur"]["action"]!=="add"){echo "class='grey'";}?>>Ajouter un joueur</button>
    <button name="action" type="submit" value="del" <?php if(isset($_SESSION["joueur"]["action"])&&$_SESSION["joueur"]["action"]!=="del"){echo "class='grey'";}?>>Supr un joueur</button>
    <button name="action" type="submit" value="mod" <?php if(isset($_SESSION["joueur"]["action"])&&$_SESSION["joueur"]["action"]!=="mod"){echo "class='grey'";}?>>Mod un joueur</button>
    </p>
    </form>
    <?php
    if(isset($_SESSION["joueur"]["action"])&&($_SESSION["joueur"]["action"]==="del"||$_SESSION["joueur"]["action"]=="mod")){ // sup et mod de joueur 
        $equipe = $bdd->query("SELECT * from equipe")->fetchAll(PDO::FETCH_ASSOC);
        $team='';
        foreach ($equipe as $key => $value) {
            if(isset($_SESSION["joueur"]["equipe"])&&$_SESSION["joueur"]["action"]==="add"){$check='class="select"';}else{$check='';}
            $team.="<button name='equipe' type='submit' value='".$equipe[$key]["id_equipe"]."'>".$equipe[$key]["nom"]."</button>";
        }
        echo '<form method="post"><p>'.$team.'</p></form>';
    }
    ?>
</body>
</html>