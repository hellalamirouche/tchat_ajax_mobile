<?php
//  création de class de membre pour l'inscription
 // cette classe permet de traiter la photo soumise dans le formulaire d'inscription et lui diminuer la taille et la transferer dans le fichier de mon site .
class Verification_photo {

    public $photo;

    public function verifPhoto(){
        // récuperer les valeures des variables du formulaire d'inscription
        global $msg;
        global $photo;
         // 2)  la photo :
        //2-1 ) controle sur l'extention images
        if(!empty($_FILES['photo']['name']) && empty($msg) )
        {
            $nom = $_FILES["photo"]["name"];
            $taille = $_FILES["photo"]["size"];
            $extention = end(explode(".", $nom));
            // les extentions autorisées:
            $extention_autorise = array("png", "jpg", "jpeg");
            if(in_array($extention, $extention_autorise))
            {
                // si la taille de img < à 3mega
                if($taille < (3072*3072))
                {
                    $nouvelle_image = '';
                    // donner un nouveau nom à l'image  em md5
                    $nouveau_nom = md5(rand()) . '.' . $extention;
                    // lien de l'image
                    $this->photo = 'assets/images/utilisateurs/' . $nouveau_nom;
                    list($width, $height) = getimagesize($_FILES["photo"]["tmp_name"]);
                    if($extention == 'png' )
                    {
                        $nouvelle_image = imagecreatefrompng($_FILES["photo"]["tmp_name"]);
                    }
                    if($extention == 'jpg' || $extention == 'jpeg' )
                    {
                        $nouvelle_image = imagecreatefromjpeg($_FILES["photo"]["tmp_name"]);
                    }
                    $new_width=400;
                    $new_height = ($height/$width)*400;
                    $tmp_image = imagecreatetruecolor($new_width, $new_height);
                    imagecopyresampled($tmp_image, $nouvelle_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                    imagejpeg($tmp_image, $this->photo, 100);
                    imagedestroy($nouvelle_image);
                    imagedestroy($tmp_image);
                }
                else
                {
                    $msg='la taille de l\'image doit etre inferieur  à  3 MB';
                }
            }
            else
            {
                $msg= 'le format de l\'image est invalide';
                $_FILES['photo']='';
            }
        }
        return $this->photo; // retourne la valeur de la variable $photo
    }





}

