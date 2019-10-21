<?php
//  création de class verif photo chat
 // cette classe permet de traiter la photo soumise dans le formulaire de chat;
class Verif_photo_chat {

     public $photo;

     function verifPhotoChat(){
        // récuperer les valeures des variables du formulaire d'inscription
        $this->photo=$_FILES['image'];
        global $msg;
         // 2)  la photo :
        //2-1 ) controle sur l'extention images
        if(!empty($_FILES["image"]["name"]))
        {
            $nom = $_FILES["image"]["name"];
            $taille = $_FILES["image"]["size"];
            
            // rendre minuscule la derniere extention car il ya des images avec l'extension en majuscule
            $extention = strtolower(  substr(  strrchr($_FILES["image"]["name"], '.')  ,1)  );
            
            // les extentions autorisées:
            $extention_autorise = array("png", "jpg", "jpeg" ,"pdf",'doc') ;
            if(in_array($extention, $extention_autorise))
            {
                // si la taille de img < à 3mega
                if($taille < (3072*3072))
                {
                    $nouvelle_image = '';
                    // donner un nouveau nom à l'image  em md5
                    $nouveau_nom = md5(rand()) . '.' . $extention;
       
                    $this->photo ='assets/images/utilisateurs/' . $nouveau_nom;
                    list($width, $height) = getimagesize($_FILES["image"]["tmp_name"]);
                    if($extention == 'png' )
                    {
                        $nouvelle_image = imagecreatefrompng($_FILES["image"]["tmp_name"]);
                    }
                    else if($extention == 'jpg'|| $extention == 'jpeg')
                    {
                        $nouvelle_image = imagecreatefromjpeg($_FILES["image"]["tmp_name"]);
                    }
                    // si c un pdf  
                    else if($extention == 'pdf')
                    {
                        $this->photo ='assets/images/utilisateurs/pdf/' . $nouveau_nom;
                        move_uploaded_file ($_FILES["image"]["tmp_name"],$this->photo);
                    }
                    
                    
                    $new_width=250;
                    $new_height = ($height/$width)*250;
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
                $_FILES['image']='';
            }
        }
        return $this->photo; // retourne la valeur de la variable $photo
    }





}

 