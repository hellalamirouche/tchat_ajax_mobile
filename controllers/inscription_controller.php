<?php
// inclure la classe inscription du membre 
include_once "_classes/inscription/inscription_membre.php";
// inclure la classe de la verification du pseudo s'il existe ou pas déja
include_once "_classes/inscription/verif_pseudo_inscription.php";
// inclure la classe pour verifier et enregistrer la photo lors de l'inscription
include_once "_classes/inscription/verification_photo.php";



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
         header('location:connexion');
      }
  } 
}