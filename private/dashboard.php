<?php

// test de validitée de connection

if(isset($_SESSION["connection"])&&($_SESSION["connection"]===True)&&(isset($_SESSION["token"]["pass"]))&&(isset($_SESSION["token"]["name"]))){
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

// resultat suite au remplissage des formulaires des boutons

if(isset($_POST["name"])){
    if(empty($bdd->query("select name from staff where name = '".$_POST["name"]."'")->fetch())){
        // chaque nom doit etre unique
        if($bdd->query('UPDATE `id` SET `name` = "'.$_POST["name"].'" WHERE `staff`.`name` = "'.$_SESSION["token"]["name"].'"')){
            echo "<script language=javascript>
	        console.log('nom modifier avec succes');
            </script> ";
        } else {
            $_POST["modName"]="";
            echo "<script language=javascript>
	        console.log('erreur de connection mais bon nom');
            </script> ";
        }
    } else {
        $_POST["modName"]="";
        echo "<script language=javascript>
        console.log('ce nom existe deja');
        </script> ";
    }
}
if(isset($_POST["password"])){
        if($bdd->query('UPDATE `staff` SET `password` = "'.hash("sha256",$_POST["password"]).'" WHERE `staff`.`name` = "'.$_SESSION["token"]["name"].'"')){
            echo "<script language=javascript>
	        console.log('mot de passe modifier avec succes');
            </script> ";
        } else {
            $_POST["modPass"]="";
            echo "<script language=javascript>
	        console.log('erreur de connection mais bon mot de passe');
            </script> ";
        }
}
if (isset($_POST["history"])){
    if($bdd->query('UPDATE `settings` SET `value` = "'.$_POST["history"].'" WHERE `settings`.`name` = "home-text"')){
        echo "<script language=javascript>
        console.log('texte histoire modifier avec succes');
        </script> ";
    } else {
        $_POST["modHistory"]="";
        echo "<script language=javascript>
        console.log('erreur de connection mais bon nom');
        </script> ";
    }
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- creation side bar -->
    <ul>
        <li class="pages">dashboard</li>
        <li class="pages">convocation</li>
        <li class="pages">joueurs</li>
        <li class="pages">equipes</li>
        <?php 
        if($rep["type"]==="president"||$rep["type"]==="conseil administration"||$rep["type"]==="admin"){
            echo '<li class="pages">staff</li>';
        }
        ?>
    </ul>
    <div class="button">
        <form action="" method="POST">
            <input type="hidden" name="modName">
            <input type="submit" value="Changer son nom">
        </form>
    </div>
    <div class="button">
        <form action="" method="POST">
            <input type="hidden" name="modPass">
            <input type="submit" value="Changer son mot de passe">
        </form>
    </div>
    <div class="button">
        <form action="" method="POST">
            <input type="hidden" name="modTrophe">
            <input type="submit" value="Changer les trophe">
        </form>
    </div>
    <div class="button">
        <form action="" method="POST">
            <input type="hidden" name="modHistory" >
            <input type="submit" value="Changer l histoire">
        </form>
    </div>


<?php 
echo '';

// gestion popup
    if(isset($_POST["modName"])){
        echo '
        <div id="popup">
        <form action="" method="post">
        <label for="currentName">Nom actuel</label>
        <p class="text-cross" id="currentName"></p>
        <label for="name">Nouveau nom</label>
        <input type="text" name="name" id="name">
        </form>
        </div>';
    }
    if(isset($_POST["modPass"])){
        echo '
        <div id="popup">
        <form action="" method="post">
        <label for="currentPass">Nom actuel</label>
        <p class="text-cross"></p>
        <label for="password">Nouveau mot de passe</label>
        <input type="password" name="password" id="password">
        <input type="submit" value="envoyer">
        </form>
        </div>';
    }
    if(isset($_POST["modTrophe"])){
        echo '
        <div>
        <form>
        <label for="cup1">
            <img src="coupe1" alt="">
        </label>
        <select name="cup1" id="cup1">
            <option value="">--Choisir une coupe--</option>
            <option value="coupe de france 2022">coupe de france 2022</option>
            <option value="coupe de france 2021">coupe de france 2021</option>
            <option value="coupe de france 2020">coupe de france 2020</option>
            <option value="coupe de france 2019">coupe de france 2019</option>
            <option value="coupe de france 2018">coupe de france 2018</option>
        </select>
        <label for="cup2">
            <img src="coupe2" alt="">
        </label>
        <select name="cup2" id="cup2">
            <option value="">--Choisir une coupe--</option>
            <option value="coupe de france 2022">coupe de france 2022</option>
            <option value="coupe de france 2021">coupe de france 2021</option>
            <option value="coupe de france 2020">coupe de france 2020</option>
            <option value="coupe de france 2019">coupe de france 2019</option>
            <option value="coupe de france 2018">coupe de france 2018</option>
        </select>
        <label for="cup3">
            <img src="coupe3" alt="">
        </label>
        <select name="cup3" id="cup3">
            <option value="">--Choisir une coupe--</option>
            <option value="coupe de france 2022">coupe de france 2022</option>
            <option value="coupe de france 2021">coupe de france 2021</option>
            <option value="coupe de france 2020">coupe de france 2020</option>
            <option value="coupe de france 2019">coupe de france 2019</option>
            <option value="coupe de france 2018">coupe de france 2018</option>
        </select>
        <input type="submit" value="envoyer">
        </form>
        </div>
        ';
    }
    if(isset($_POST["modHistory"])){
        echo '
        <div>
        <form>
        <label for="history"></label>
        <input type="text" name="history" id="history">
        <input type="submit" value="envoyer">
        </form>
        </div>
        ';
    }

    ?>
</body>
</html>