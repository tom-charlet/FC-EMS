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
    <title>Document</title>
</head>
<body>
    <h3>Photos</h3>
    <h4>Liste photos</h4>
    <table>
        <tr>
            <th><p>Titre</p></th>
            <th><p>Equipe</p></th>
            <th><p>Article</p></th>
            <th><p>Action</p></th>
        </tr>
    <?php 

    // ajouter inner join pour recup titre article
    $photo=$bdd->query("SELECT media.*,article.titre from media left join article on media.article = article.id_article  order by id_media desc")->fetchAll(PDO::FETCH_ASSOC);
    var_dump($photo[0]);
    // reflechir au systeme de disable en cas d absence de 

    foreach ($photo as $key => $value) {
        if($photo[$key]["article"]===NULL){
            $class="class='cross'";
            $article="";
        } else {
            $class="";
            $article=$photo[$key]["titre"];
        }
        echo "<tr> 
        <td>".explode("|",$photo[$key]["nom"])[1]."</td>
        <td>Temporaire</td>
        <td ".$class.">".$article."</td>
        <td>
        <form id='form".$photo[$key]["id_media"]."-delete'>
            <input type='hidden' name='delete' value='".$photo[$key]["id_media"]."'>
            <button type='submit' form='form".$photo[$key]["id_media"]."-delete'><img src='../assets/bin.svg' alt='poubelle'></button>
        </form>
        <form id='form".$photo[$key]["id_media"]."-edit'>
            <input type='hidden' name='edit' value='".$photo[$key]["id_media"]."'>
            <button type='submit' form='form".$photo[$key]["id_media"]."-edit'><img src='../assets/edit.svg' alt=''></button>
        </form>
        </td>
        </tr>";
    }
    ?>
    </table>
</body>
</html>