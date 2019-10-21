<?php

/**
 * Permet de sécuriser une chaine de caractères
 * @param $string
 * @return string
 */
function str_secur($string) {
    return trim(htmlspecialchars($string));
}

/**
 * Debug plus lisible des différentes variables
 * @param $var
 */
function debug($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

//foction permettant de savoir si l'utilisateur est connecté
function isconnected(){
    if(isset($_SESSION['membre'])){	
      return true;
    }
    return false;
  }
  //fonction permettand de savoir si l'utilsateur a le statut administrateur.
  function isAdmin(){
    if(isconnected() && $_SESSION['membre']['statut'] == 2){
      return true;
    }
    return false;
  }
  
// fonction de deconnexion 

  function Deconnexion(){
    // appelé le pdo de la connexion sinon tu auras une erreur 
     global $pdo; 
     global $pseudo;
      // changer le statut du membre à 0 qui représente la personne déconnectée selon ma définition. afin d'avoir un statut horligne .
      $statut_enligne=$pdo->query("UPDATE membre SET statut = 0 WHERE pseudo='$pseudo'");
      // rendre le statut de la discussion 0 pour enlever la personne de mes discussions 
      $statut_discussion=$pdo->query("UPDATE mes_discussion SET etat_contact = '0' WHERE expediteur='$pseudo'");
      session_destroy();
      unset($_SESSION);
      // unset($_SESSION['membre']); tu peux utiliser aussi pour detruire la session
      header('location:connexion');
      exit;
  
}


// insertion message de chat dans la base de donnée

function insert_message(){
  // appelé le pdo de la connexion sinon tu auras une erreur 
  global $pdo;
  // global - appeler les autres variables  dont tu as besoin   dans la fonction  en global sinon ca ne marchera pas
  global $message;
  global $photo_envoye_chat;
  global $pseudo;
  global $destinataire;
  // si 
  if($photo_envoye_chat==$_FILES['image']){
    $photo_envoye_chat='';
  }
  // si le message n'est pas vide ou la photos n'est pas vide
  if(!empty($message) || !empty($photo_envoye_chat)){
      // j'ai galéré 1h a cause de ne pas avoir récuperer les données du formulaire dans une variable  $_POST=$_POST['messenger'] .
      $insert_message=$pdo->prepare("INSERT INTO messages (id_message ,messages,image,date_message , expediteur,destinataire,lecture) VALUES(null , :messenger ,'$photo_envoye_chat', NOW() , '$pseudo','$destinataire' ,'non')" );
      $insert_message-> bindParam(':messenger' ,$message ,PDO::PARAM_STR );
      // $insert_message-> bindParam(':image' ,$_FILES_bdd ,PDO::PARAM_STR );
      $insert_message->execute();
      unset($message);
  }
}

// creéer un id de discussion :

function insert_id_discussion(){
  // appelé le pdo de la connexion sinon tu auras une erreur 
  global $pdo;
  global $pseudo;
  global $destinataire;
  global $message;
  if(!empty($destinataire) && !empty($message) ){
      //verification de l'existence ou pas de l'id message ou l'expediteur est moi 
      $verif_iddiscussion= $pdo->query("SELECT id_discussion FROM mes_discussion WHERE destinataire ='$destinataire' and expediteur='$pseudo'  ");
      $verif_iddiscussion->execute(); 
      if($verif_iddiscussion->rowCount()== 0 ){
        // inserer un id discussion nouvelle
        $insert_discussion=$pdo->prepare("INSERT INTO mes_discussion (id_discussion ,expediteur,destinataire,etat_contact,date_discussion) VALUES(null , '$pseudo','$destinataire' , '1' , NOW() )" );
        $insert_discussion->execute();
      }

  }

}

  