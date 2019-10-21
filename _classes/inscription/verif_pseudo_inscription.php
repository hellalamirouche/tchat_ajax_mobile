<?php
// cette classe permettra de verifier si le pseudo existe déja ou pas lors de l'inscription.

class VerifPseudo {

    public $pseudo ;

    static function verificationPseudo(){
        global $pdo;
        global $pseudo;
        global $msg;
        // verification du pseudo si il existe :
            $verif_pseudo=$pdo->prepare("SELECT * FROM membre WHERE pseudo =:pseudo ");
            $verif_pseudo->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
            // il ne faut pas oublier execut() sinon ca ne fonctinnera jamais .
            $verif_pseudo->execute();
            if($verif_pseudo->rowCount()>0 ){
        
                $msg.='<div class="alert alert-danger mt-2 text-center"> Ce pseudo existe déja </div>';
            }
        // verification du pseudo s'il respecte les normes  de caractere avec preg_match et du nombre avec ivonv_strln
            $verification_pseudo =  preg_match('#^[a-zA-Z0-9._-]+$#',$_POST['pseudo']);

            if(!$verification_pseudo && !empty($pseudo)){

            $msg.='<div class="alert alert-danger text-center"> Les Caractères acceptés sont : A à Z et 0 à 9 <br> verifierz votre Pseudo </div>';

            }
            if(iconv_strlen($pseudo)<3 || iconv_strlen($pseudo)>13 ){

            $msg.= '<div class="alert alert-danger text-center"> Le Pseudo doit avoir entre 3 et 13 caractères inclus  <br> verifierz votre Pseudo </div>';

            }
            return $msg;
         
    }

}