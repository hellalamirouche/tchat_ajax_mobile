<?php
// cette classe permet de récuperer les données du destinataire lorsque on appuie sur select 
class Recup_desinataire{
   public $info_destinataire;

   public function __construct(){
        global $pdo;
        global $destinataire;
            if (isset($_GET['action']) && $_GET['action']=='select' || isset($_POST['envoyer'])){
                $destinataire=$_GET['pseudo'];
                $id_destinataire=$_GET['id_membre'];
                // recuperation du destinataire en cliquant sur select un destinataire de chat
                $rec_destinataire=$pdo->query("SELECT * FROM membre WHERE pseudo = '$destinataire'");
                $rec_destinataire->execute();
                $this->info_destinataire=$rec_destinataire->fetch(PDO::FETCH_ASSOC);

            }
            else{
                // si ya pas de session message
                $_POST='';
            }
    }

}