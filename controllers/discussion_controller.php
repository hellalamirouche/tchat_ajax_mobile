<?php 
 // inclure la classe de verif photo
 include_once "_classes/chat/photo_chat.php";
 //
 include_once "_classes/chat/rec_destinataire.php";

//le pseudo du membre connecté :
$pseudo= $_SESSION['membre']['pseudo'];
$sexe=$_SESSION['membre']['sexe'];
// si tu n'es pas connecté :
if(!isconnected()){
    header("location:connexion");  // si l'utilisateur n'est pas connecté il se redérige vers connexion.php
    exit();
}

// suppression des listes de contactes avec qui je discute 
if (isset($_GET['action'])&& $_GET['action']=='supprimer')  {
    
    $destinataire = $_GET['destinataire'];
    
    $suppression_contact_de_ma_liste=$pdo->query(" UPDATE mes_discussion SET etat_contact = '0' WHERE expediteur='$pseudo' and destinataire='$destinataire' ");
    $suppression_contact_de_ma_liste->execute();
} 


/* recuperation information du destinataire en appuiyant sur son icone select dans le chat .
   avec la class Recup_desinataire */
if (isset($_GET['action']) && $_GET['action']=='select' || isset($_POST['envoyer'])){
  $recupDestinataire= new Recup_desinataire(); 
  // rendre le message lu en lui changeant le statut de non à lu en cliquant sur select
  $rendreMessageLu=$pdo->query(" UPDATE messages SET lecture = 'lu' WHERE expediteur='$destinataire' and destinataire='$pseudo' ");
  $rendreMessageLu->execute();
}
// insertion de $recupDestinataire->info_destinataire['age'] , ['sexe'] , ['photo']  chat_view.php pour affivher les données du destinataire



// récupération de tout les messages entre deux personnes:

$rec_tout_message=$pdo->query("SELECT * FROM (
    SELECT * FROM messages WHERE expediteur='$pseudo' AND destinataire = '$destinataire' OR expediteur='$destinataire' AND destinataire = '$pseudo' ORDER BY id_message DESC limit 10 ) sub ORDER BY id_message ASC  ");
$rec_tout_message->execute();

// affichage des message avec la boucle while dans view 

// liste des persinnes avec qui je discute
$rec_mes_message=$pdo->prepare("SELECT *
FROM membre
INNER JOIN mes_discussion ON membre.pseudo = mes_discussion.destinataire and expediteur = '$pseudo' and etat_contact='1' ");
$rec_mes_message->execute();
// affichage avec la boucle dans view



//empecher le renvoie du formulaire et l'icone qui nous invite a accepter le renvoie du formulaire
if(isset($_POST['envoyer']) ){
    //ce code sert à renvoyer sur la meme page
    $fichierActuel = $_SERVER['PHP_SELF'] ;
    if(!empty($_SERVER['QUERY_STRING']))
    {
        $fichierActuel .= '?' . $_SERVER['QUERY_STRING'] ;
    }
    
        header('Location: ' . $fichierActuel);
        exit;
        
}


 

// select le dernier id inserer dans les message 
// $selectLastId=$pdo->query("SELECT Max(id_message) as max_id_message FROM  messages WHERE expediteur='$pseudo' AND destinataire = '$destinataire' OR expediteur='$destinataire' AND destinataire = '$pseudo' ");
// $selectLastId->execute();
// $dernierId=$selectLastId->fetch(PDO::FETCH_ASSOC);
// $dernierId['max_id_message'];

?>
    
