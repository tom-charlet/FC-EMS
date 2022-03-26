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

if(isset($_POST["edit"])){
    $_SESSION["article"]=$bdd->query("SELECT * from article where id_article = ".$_POST["edit"]."")->fetch();
    $_SESSION["article"]["action"]="edit";
}


if(!isset($_SESSION["article"])){
    $_SESSION["article"]=[];
}
if(isset($_POST["id_article"])){$_SESSION["article"]["id_article"]=$_POST["id_article"];}
if(isset($_POST["titre"])){$_SESSION["article"]["titre"]=$_POST["titre"];}
if(isset($_POST["keyword"])){$_SESSION["article"]["keyword"]=$_POST["keyword"];}
if(isset($_POST["sub"])){$_SESSION["article"]["sub"]=$_POST["sub"];}
if(isset($_POST["texte"])){$_SESSION["article"]["texte"]=$_POST["texte"];}
if(isset($_POST["date"])){$_SESSION["article"]["date"]=$_POST["date"];}
if(isset($_POST["type"])){$_SESSION["article"]["type"]=$_POST["type"];}


// traitement creation / modificaion
if(isset($_SESSION["article"]["action"])&&isset($_POST['sub'])){
    // cas ajout
    if($_SESSION["article"]["action"]==="add"){
        $tmp=$bdd->query("select * from article where titre = '".$_SESSION["article"]["titre"]."'")->fetch();
        if(empty($tmp)){
            if($bdd->query("INSERT INTO article (`titre`, `keyword`, `sub`, `texte`, `auteur`, `date`, `type`) VALUES ('".$_SESSION["article"]["titre"]."','".$_SESSION["article"]["keyword"]."','".$_SESSION["article"]["sub"]."','".$_SESSION["article"]["texte"]."',".$rep["id_staff"].",'".$_SESSION["article"]["date"]."','".$_SESSION["article"]["type"]."')")){
                echo '<div id="error">L article a bien ete creer</div>';
            }
            // unset($_SESSION["article"]);
        } else {
            echo '<div id="error">Un article avec le meme nom existe deja</div>';
        }
    } else if($_SESSION["article"]["action"]==="mod"&&isset($_POST["id_article"])){
        if($bdd->query("UPDATE article SET `titre` = '".$_SESSION["article"]["titre"]."', `keyword`= '".$_SESSION["article"]["keyword"]."', `sub`= '".$_SESSION["article"]["sub"]."', `auteur`= ".$rep["id_staff"].", `date`= '".$_SESSION["article"]["date"]."' , `type`= '".$_SESSION["article"]["type"]."' where id_article = ".$_POST["id_article"]."")){
            echo "Article modifié";
        }
        $supr=$bdd->query("SELECT nom from media where article = ".$_POST["id_article"]."")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($supr as $key => $value) {
            if(unlink("../img/".explode("|",$value["nom"])[0])){
                echo "image supprimer sur le serveur" ;
            }
        }   
        if($bdd->query("DELETE from media where article = ".$_POST["id_article"]."")){
            //images supr de la bdd
        }
    }

    //test si il y a des photos
    if($_FILES["upload"]["size"][0]!=0){
        //traitement des images (creer un tableau ou chaque index est une photo valide)
        $photo=[];
        foreach ($_FILES["upload"]["name"] as $key => $value) {
            if($_FILES["upload"]["error"][$key]==0&&explode("/",$_FILES["upload"]["type"][$key])[0]=="image"){
                $photo[]=["name"=>(nom().".".explode("/",$_FILES["upload"]["type"][$key])[1]),"full_path"=>$_FILES["upload"]["full_path"][$key],"type"=>$_FILES["upload"]["type"][$key],"tmp_name"=>$_FILES["upload"]["tmp_name"][$key],"error"=>$_FILES["upload"]["error"][$key],"size"=>$_FILES["upload"]["size"][$key]];
            }
        }
    
        //recuperation id pour photos
        if($_SESSION["article"]["action"]==="mod"){
            $id=$_POST["id_article"];
        } else if ($_SESSION["article"]["action"]==="add"){
            $id=$bdd->query("SELECT id_article where `date` = '".$_SESSION["article"]["date"]."' AND titre = '".$_SESSION["article"]["titre"]."'")->fetch();
            $id=$id['id_article'];
        }
        

        //ajout des photos
        if(isset($id)){
            foreach ($photo as $key => $value) {
                while(file_exists("../img/".$value["name"])){
                    $value["name"]=nom().".".explode("/",$_FILES["upload"]["type"][$key])[1]; // permet d'eviter qu'un fichier n existe pas 2 fois
                }
                if (move_uploaded_file($value["tmp_name"],"../img/".$value["name"])) {
                    $bdd->query("insert into media (nom, type,article) VALUES ('".$value["name"]."|".($a=(isset($_POST["pic-desc"])?$_POST["pic-desc"]:"photo n ".($key+1)." de l'article du ".$_SESSION["article"]["date"]))."','".explode("/",$value["type"])[0]."',".$id.")");
                    echo "Le média a été ajouté dans le serveur";
                    unset($_SESSION["media"]);
                } else {echo "<p>Probleme lors du televersement</p>";}
            }
        }
    }
}

//traitement supr
if(isset($_POST["delete"])){
    $supr=$bdd->query("SELECT nom from media where article = ".$_POST["delete"]."")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($supr as $key => $value) {
        if(unlink("../img/".explode("|",$value["nom"])[0])){
            echo "image supprimer sur le serveur" ;
        }
    }   
    if($bdd->query("DELETE from media where article = ".$_POST["delete"]."")){
        //images supr de la bdd
    }
    if($bdd->query("DELETE from article where id_article = ".$_POST["delete"]."")){
        //article supr de la bdd
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th><p>Titre</p></th>
            <th><p>Date</p></th>
            <th><p>Mots-Clefs</p></th>
            <th><p>Action</p></th>
        </tr>
    <?php 
    $article=$bdd->query("select * from article order by 'id_article' desc")->fetchAll();


    //finir les boutons de suppr et edit
    
    
    foreach ($article as $key => $value) {
        echo "<tr> 
        <td>".$article[$key]["titre"]."</td>
        <td>".$article[$key]["date"]."</td>
        <td>".$article[$key]["keyword"]."</td>
        <td>
        <form id='form".$article[$key]["id_article"]."-delete' method='post'>
            <input type='hidden' name='delete' value=".$article[$key]["id_article"].">
            <button type='submit' form='form".$article[$key]["id_article"]."-delete'><img src='../assets/bin.svg' alt='poubelle'></button>
        </form>
        <form id='form".$article[$key]["id_article"]."-edit' method='post'>
            <input type='hidden' name='edit' value=".$article[$key]["id_article"].">
            <button type='submit' form='form".$article[$key]["id_article"]."-edit'><img src='../assets/edit.svg' alt=''></button>
        </form>
        </td>
        </tr>";
    }
    ?>
    </table>
    <form method="post">
        <button name="add" type="submit" <?php if(isset($_SESSION["joueur"]["action"])&&$_SESSION["joueur"]["action"]!=="add"){echo "class='grey'";}?>>Ajouter un Article</button>
    </form>
    <?php
    if(isset($_POST["add"])){
        unset($_SESSION["article"]);
    }
    // affichage formulaire pour edit et ajout 
    if(isset($_POST["edit"])||isset($_POST["add"])){
        if(isset($_POST["edit"])){$_SESSION["article"]["action"]="mod";}
        if(isset($_POST["add"])){$_SESSION["article"]["action"]="add";}
        echo '<div id="form-article">
        <form action="" method="post" enctype="multipart/form-data">
            <div id="part1">
                <label for="type1"><img src="../icon/form1.jpg" alt="template d article 1" srcset=""></label>
                <input type="radio" name="type" id="type1" value="1" '.($a=(isset($_SESSION["article"]["type"])&&$_SESSION["article"]["type"]===1)?'checked="checked"':'').'>
                <label for="type2"><img src="../icon/form2.jpg" alt="template d article 2" srcset=""></label>
                <input type="radio" name="type" id="type2" value="2" '.($a=(isset($_SESSION["article"]["type"])&&$_SESSION["article"]["type"]===2)?'checked="checked"':'') .'>
            </div>
            <div id="part2">
                './*Transimssion id pour modification*/($a=(isset($_SESSION["article"]["id_article"]))?'<input type="hidden" name="id_article" value="'.$_SESSION["article"]["id_article"].'">':"").'
                <!-- form a gerer en js (a voir)-->

                <p>
                    <label for="titre">Titre</label>
                    <input type="text" name="titre" id ="titre" maxlength="80" required '.($a=(isset($_SESSION["article"]["titre"]))?'value="'.$_SESSION["article"]["titre"].'"':"").'>
                </p>
                <p>
                    <label for="sub">Phrase d accroche</label>
                    <textarea id="sub" name="sub" rows="10" cols="33" maxlength="500" required >'.($a=(isset($_SESSION["article"]["sub"]))?$_SESSION["article"]["sub"]:"").'</textarea>
                </p>
                <p>
                    <label for="upload">Photo</label>
                    <input type="file" name="upload[]" id="upload" multiple>
                    <label for="pic-desc">Description photo (si il y a plusieurs photos, les descriptions sont automatiques)</label>
                    <input type="text" name="pic-desc" id ="pic-desc" size="25" maxlength="80">
                </p>
                <p>
                    <label for="texte">Texte</label>
                    <textarea id="texte" name="texte" rows="10" cols="33" required>'.($a=(isset($_SESSION["article"]["texte"]))?$_SESSION["article"]["texte"]:"").'</textarea>
                </p>
                <p>
                    <label for="keyword">Mots clefs (séparé par des ";")</label>
                    <input type="text" name="keyword" id ="keyword" maxlength="100" required '.($a=(isset($_SESSION["article"]["keyword"]))?'value="'.$_SESSION["article"]["keyword"].'"':"").'>
                </p>
                <p>
                    <label for="date">Date</label>
                    <input type="text" name="date" id ="date" maxlength="20" required placeholder="FormatAnnéeMoisJour" value="'.($a=(isset($_SESSION["article"]["date"]))?$_SESSION["article"]["date"]:date("Ymd")).'">
                </p>
                
            </div>
            <button type="submit">Ajouter l article</button>
        </form>
    </div>';
    }
    
    ?>
    <script src="admin.js"></script>
</body>
</html>