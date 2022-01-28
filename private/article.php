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
$bdd=bdd_connection();
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
    $article=$bdd->query("select * from rencontre order by 'id-article' desc")->fetchAll();


    //finir les boutons de suppr et edit
    
    
    foreach ($article as $key => $value) {
        echo "<tr> 
        <td>".$article[$key]["titre"]."</td>
        <td>".$article[$key]["date"]."</td>
        <td>".$article[$key]["keyword"]."</td>
        <td>
        <form id='form".$article[$key]["id-article"]."-delete'>
            <input type='hidden' name='delete' value='".$article[$key]["id-article"]."'>
            <button type='submit' form='form".$article[$key]["id-article"]."-delete'><img src='../icon/seo-social-web-network-internet_262_icon-icons.com_61518.svg' alt='poubelle'></button>
        </form>
        <form id='form".$article[$key]["id-article"]."-edit'>
            <input type='hidden' name='delete' value='".$article[$key]["id-article"]."'>
            <button type='submit' form='form".$article[$key]["id-article"]."-edit'><img src='../icon/' alt=''></button>
        </form>
        </td>
        </tr>";
    }
    ?>
    </table>
</body>
</html>