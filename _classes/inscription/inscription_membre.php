<?php
//  création de class de membre pour l'inscription
// cette classe permet d'inserer les données de la personne qui s'inscrit sur le site .
// elle récupere la photo_utilisateur traitée auparavant par la classe de traitement de la photo et aussi récupere les autres inputs du formulaire d'inscription .
// elle insert tout dans la base de données .

class Membres_inscription {

    public $pseudo;
    public $mdp;
    public $photo_utilisateur; // la photo qu on récupere c'est le résultat du traitement de la classe verification photo
    public $sexe;
    public $age;
    public $photo;
    public $message_erreur;
     
     function __construct(){
      // déclarer les variable externe en global pour les récuperés ici comme la connexion $pdo et le traitement de la photo $photos_inscription 
        global $pdo;
        global $photos_inscription; // photo issue du résultat du traitement par la class verif photos inscription;
        global $pseudo;
        global $mdp;
        global $sexe;
        global $age;
        $this->message_erreur;
       
     // affecté la variable globale a la photo
        
     // faire les instructions d'enregistrement du membre
       $enregistrement= $pdo->prepare("INSERT INTO membre (id_membre ,pseudo ,photo, date_enregistrement,statut,sexe ,age,mdp) VALUES(null ,:pseudo,:photo , NOW(), 0 , :sexe , :age ,:mdp )" );
       //avec ce code la  on peut changer certains indices sans les autres  meme la photos on peut la changer
       $enregistrement-> bindParam(':pseudo' ,$pseudo,PDO::PARAM_STR );
       $enregistrement-> bindParam(':photo' ,$photos_inscription,PDO::PARAM_STR );
       $enregistrement-> bindParam(':sexe' ,$sexe,PDO::PARAM_STR );
       $enregistrement-> bindParam(':age' ,$age ,PDO::PARAM_STR );
       $enregistrement-> bindParam(':mdp' ,$mdp ,PDO::PARAM_STR );
       // $enregistrement-> bindParam(':photo' ,$photo ,PDO::PARAM_STR );
       // n'ouble pas execute()
       $enregistrement-> execute();
       header("location:index.php");
    }





}