<?php 
// header("Location: html/index.php");

function bdd_connection(string $user="root",string $pass=""){
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=fcems', $user, $pass);
    } catch (PDOException $e) {
        echo "<script language=javascript>
        console.log('erreur " . $e->getMessage() ."');
    </script>";
        die();
    }
    echo "<script language=javascript>
        console.log('Page bien connectée à la base de données');
    </script>";
    return $dbh;
}

function traitement_date(string $var)
{
    // a finir , affichage de valeur sur article
}
//pour generer des noms
function nom(){
    $long=rand(15,25);
    $letters = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $nom="";
    for ($i=0; $i < $long; $i++) { 
        $nom=$nom.substr($letters,rand(0,strlen($letters)),1);
    }
    return $nom;
}

// voir si pas usine a gaz
function get_rank(string $rank="entraineur"){
    $nb=0;
    switch ($rank) {
        case 'admin':
            $nb===4;
            break;
        case 'president':
        case 'conseil administration':
            $nb===3;
            break;
        case 'staff':
            $nb===2;
            break;
        case 'entraineur':
            $nb===1;
            break;
        default:
            $nb===0;
            break;
    }
    return $nb;
}


// traitement match
function update_Match(){
    $bdd=bdd_connection();
    $equipe=$bdd->query("SELECT id,lien from categorie ")->fetchAll(PDO::FETCH_ASSOC);

    foreach ($equipe as $key => $value) {
        traitement_match($value["id"],$value["lien"]);
    }
    
}
function traitement_match($nomEquipe,$lien){
    /************recuperation des noms d'equipes*******/
    //tableau des equipes
    $url=explode("|",$lien)[0];
    $nom_eqp=explode("|",$lien)[1];
    //appel des fonctions + renvoye bdd


    // L'URL du site à scraper 
    // A Changer 
    // $url = 'https://www.fff.fr/competition/club/552519-f-c-eure-madrie-seine/equipe/2021121182SEM1/resultats-et-calendrier.html';
    //echo '<pre>';
    $code = scraper($url);
    //echo '</pre>';
    /***
    Code d'un scraper avec Curl réalisé par Julien Cordier
    ***/
    function scraper ($url) {
    //permet de récupérer le contenu d'une page
    // User Agent
    $ua = 'Mozilla/5.0 (Windows NT 6.1; rv:22.0) Gecko/20100101 Firefox/22.0';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    curl_setopt($ch, CURLOPT_URL, $url );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
    // le scraper suit les redirections
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $result = curl_exec($ch);
    curl_close ( $ch );
    return $result;
    }
    
    preg_match_all('/<div class="uppercase margin_b20 compet_nom bold">(.*?)<!-- .aside_resultat_match -->/s', $code, $matches);
    //var_dump($matches);

    $tab=$matches[1];

    function data_tri($tab,$cutWord){
        for ($i = 0; $i < count($tab); $i++) {
            echo "info : ".strip_tags($tab[$i])."";
            $test=strip_tags($tab[$i]);
            //echo $test;
            $cutWord="Senior";
            
            $coupe1=explode($cutWord,$test);
            $coupe2=explode(" - ",$coupe1[1],4);
            $comp=$coupe1[0];
            $date_m=$coupe2[1]." ".substr($coupe2[2], 0, 5);
            //var_dump($coupe2);
            $ekp_un=substr($coupe2[2], 6, -3);
            //$res_ekp_un=substr($coupe2[2],-2);
            $score=substr($coupe2[2],-2)." - ".substr($coupe2[3], 0, 4);
            $ekp_deux=substr($coupe2[3], 3, -1);
            //$res_ekp_deux=substr($coupe2[3], 0, 4);
            
            /*echo "</br>";
            //var_dump($coupe2);
            echo "competition :". $comp."</br>";echo "date :". $date_m."</br>";echo "equipe 1 :". $ekp_un."</br>";echo "score ekp 1 :". $res_ekp_un."</br>";echo "score :".$score."</br>";echo "equipe 2 :". $ekp_deux."</br></br></br>";echo "score ekp 2 :". $res_ekp_deux."</br></br></br>";
            */
            //la var match contient une ligne pour chaque match decoupé 
            $match[$i]=['coupe'=>$comp,'date'=>$date_m,'equipe1'=>$ekp_un,'equipe2'=>$ekp_deux,'score'=>$score];
        }
        return $match;
    }
    
    $match=data_tri($tab,$nom_eqp);
    insertion_Match($match,$nomEquipe);
    
    function insertion_Match(array $match,int $cat){
        $bdd=bdd_connection();
        //Loop pour tout les match
        $k=0;
        foreach ($match as $key => $value) {
            //test si le match existe
            $id=$bdd->query("SELECT * from rencontre where categorie = ".$cat." AND nom = '".$value["coupe"]."' AND equipe_int = '".$value["equipe1"]."' AND equipe_ext = '".$value["equipe2"]."' AND date LIKE '".substr($value["date"],0,6)."%'")->fetch();
            if(empty($id)){
                //Ajout de match 
                if($bdd->query("INSERT INTO rencontre (categorie,nom,`date`,equipe_int,equipe_ext,score) VALUES (".$cat.",'".$value["coupe"]."',".$value["date"].",'".$value["equipe1"]."','".$value["equipe2"]."','".$value["score"]."')")){
                    //match ajouté
                }
                //mise a jour du score si celui ci est null (egal a "-") OU qu il faut le mettre a jour         A voir pour match reporté
            } else if(isset($id["score"])&&($id["score"]==="-"||$id["score"]!==$value["score"])){
                //mise a jour du score
                if($bdd->query("UPDATE rencontre SET score = '".$value["score"]."',date = ".$value["date"]."")){
                //score update
            } 
            //test pour voir si on est remonté assez loin pour arreter d update (test de date , equipeS categorie et score)
            } else if(!empty($id)&&$id["date"]===$value["date"]&&$id["equipe_int"]===$value["equipe1"]&&$id["equipe_ext"]===$value["equipe2"]){
                //le match existe donc 
                $k++;
            }
            //test si on arrete l'update
            if($k>=3){
                break;
            }
        }
    }

    }
?>