<?php
// inclure la classe inscription du membre 
include_once "_classes/inscription/inscription_membre.php";
// inclure la classe de la verification du pseudo s'il existe ou pas déja
include_once "_classes/inscription/verif_pseudo_inscription.php";
// inclure la classe pour verifier et enregistrer la photo lors de l'inscription
include_once "_classes/inscription/verification_photo.php";

// traitement pour la connexion 

$pseudo='';
$msg_connexion='';

if( isset($_POST['pseudo']) && isset($_POST['mdp']) && isset($_POST['connexion'])){
  // la valeur du pseudo
  $pseudo=trim($_POST['pseudo']); 
  $mdp=$_POST['mdp'];
  // si le pseudo est vide 
  if(empty($_POST['pseudo'])){
    $msg_connexion.='<div class="alert alert-danger mt-2 text-center"> Veuillez renseigner votre pseudo</div>';
  
  }
  if(empty($_POST['mdp'])){
    $msg_connexion.='<div class="alert alert-danger mt-2 text-center"> veuillez renseigner un mot de passe </div>';
  
  }
  // verifier certeines parametre si le pseudo est remplie et ya pas de message d'erreurs 
    if(empty($msg_connexion) && !empty($_POST['pseudo']) && !empty($_POST['mdp'])){
     
          // recuperation du membre 
          $connexion_user=$pdo->prepare("SELECT * FROM membre WHERE pseudo =:pseudo ");
          $connexion_user->bindParam(':pseudo',$pseudo,PDO::PARAM_STR);
          $connexion_user->execute();
          // verification du pseudo si il existe :
          // si le pseudo est disponible et qu on veut que la personne s'inscrive 
          if($connexion_user->rowCount()== 0 ){
            $msg_connexion.='<div class="alert alert-danger mt-2 text-center"> Ce pseudo est disponible il vous faut juste de s\'inscrire</div>';
          }
          $infos_membre=$connexion_user->fetch(PDO::FETCH_ASSOC);
          // verifier le mdp
          $hashed_password=$infos_membre['mdp'];
          // verif de la ressemblance du mot de passe   
          if(!password_verify($_POST['mdp'], $hashed_password)) {
            $msg_connexion.='<div class="alert alert-danger mt-2 text-center"> Votre pseudo ou mot de passe ne sont pas bon</div>';
          }
          // si on a un pseudo déja enregistré en lui change le statut à connecté
          if($connexion_user->rowCount()>0) {
              // changer le statut du membre à 1 qui représente la personne connectée selon ma définition. afin d'avoir un statut enligne .
              $statut_enligne=$pdo->query("UPDATE membre SET statut = 1 WHERE pseudo='$pseudo'");
              // on récupere le membre et on va aller vers tchat.php
          }
          // si tout va bien en lui crée une session
          if(empty($msg_connexion)){
              // si tout va bien tu déclare une session membre comme un tableau array qui contient les données du membre connecté :
              $_SESSION['membre']=array(); 
              $_SESSION['membre']['id_membre']=$infos_membre['id_membre'];       
              $_SESSION['membre']['pseudo']=$infos_membre['pseudo'];       
              $_SESSION['membre']['photo']=$infos_membre['photo']; 
              $_SESSION['membre']['date_enregistrement']=$infos_membre['date_enregistrement'];
              $_SESSION['membre']['statut']=$infos_membre['statut'];  
              $_SESSION['membre']['sexe']=$infos_membre['sexe'];  
              $_SESSION['membre']['age']=$infos_membre['age']; 
              
              header('location:tchat')    ;
              
            }
        }
    }      



// traitement pour l'inscription

if(isset($_POST['valider'])){
  $pseudo='';
  $msg='';
// si un des éléments est vide n'enregistre pas la personne sauf la photo
  if (empty($_POST['pseudo'])){
      $msg.='<div class="alert alert-danger mt-2 text-center"> Il faut renseigner le pseudo </div>';
     }else if(empty($_POST['sexe'])){
      $msg.='<div class="alert alert-danger mt-2 text-center"> Il faut renseigner le sexe </div>';
     }else if(empty($_POST['age'])){
      $msg.='<div class="alert alert-danger mt-2"> Il faut renseigner votre age </div>';
     }
  // si tout va bien commence à enregistrer 
   else if( !empty($_POST['pseudo']) && !empty($_POST['sexe']) && !empty($_POST['age']) ){
  
      // 1)  présentation des variables
      $pseudo=strtolower(trim($_POST['pseudo']));
      $sexe=$_POST['sexe'];
      $age=$_POST['age'];
      $photo=$_FILES['photo'];
      // hasher le mdp pour la base de donnée
      $mdp=password_hash($_POST['mdp'], PASSWORD_DEFAULT);
      // la classe qui verifie l'existence ou pas du pseudo dans la base de données.
      $verification_pseudo= VerifPseudo::verificationPseudo();// puisque la methode est static dans la classe on a pas besoin d'instencier l'objet du coup on l'appel direct avec les deux points.
      
      // instantiation de l'objet de verif photo
    
      $verif_photo= new Verification_photo();
      // affectation de la valeur de la photo à une variable pour l'inserer dans la bdd 
      
      // appeler la methode de verification photo
      $verif_photo->verifPhoto();
      
      $photos_inscription=$verif_photo->photo;
       
     // si la photo n'est pas vide  fait lui la verif et l'enregistrement dans la bdd
      
      // operation d'insertion des données d'inscription 
      if(empty($msg)){
       
       // appelé la classe qui sert à effectuer l'inscription
         $enregistrement= new Membres_inscription();
      }
  } 
}