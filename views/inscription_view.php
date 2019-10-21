<!doctype html>
<html>
<head>

    <?php include_once 'views/includes/head.php'?>

  
</head>

<body>

    <?php include_once 'views/includes/header.php'?>

   
    
    <div class=" col-xl-10 mx-auto px-0 " >
    <h2 class="text-center p-4  w-100"><img src="assets/images/inscription.png" alt="inscription" style="width:50px;"></h2>
    <?php echo $msg ;?>
        <form class="col-sm-12 p-4 text-white bg-dark " method="post" enctype="multipart/form-data">
            <div class="input-group mb-3">
                <label for="pseudo" class="col-12 pb-4 px-0">Pseudo</label>
                <input type="text" class="form-control" placeholder="Pseudo"  id="pseudo" name="pseudo">
            </div>
            <div class="input-group mb-3">
                <label for="mdp" class="col-12 pb-4 px-0">Mot de passe</label>
                <input type="password" class="form-control" placeholder="mot de passe"  id="mdp" name="mdp">
            </div>
            <div class="form-group">
                <label for="sexe">sexe</label>
                <select class="form-control" id="sexe" name="sexe">
                    <!--  il faut mettre value a option sinon ça ne fonctionne pas our l'enregistrement -->
                    <option selected value=''>sexe</option>
                    <option value="f">Femme</option>
                    <option value="m">homme</option>
                </select>
            </div>
            <div class="form-group">
                <label for="age" >Age</label>
                <select class="form-control" id="age" name="age">
                    <!--  il faut mettre value a option sinon ça ne fonctionne pas our l'enregistrement -->
                    <option selected value=''>Age</option>
                    <?php // affichage d une boucle de l'age de 10 ans à 100 ans
                    for ($i=10;$i<= 100 ; $i++){
                        echo '<option value="'.$i.'">'.$i.'</option>' ;
                    } ?>
                </select>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="photo" name="photo">
                <label class="custom-file-label" for="inputGroupFile03">Photo</label>
            </div>
            <div class="form-group">
                <input class="btn  text-dark w-100 my-3 bg-white" type="submit" value="Valider" name="valider" id="valider">
            </div>
            
        </form>   
        <p class='text-center py-4 col-12'><a class="text-center mx-auto " href="?page=connexion" style="font-size:1.4em">Connexion</a></p>

        
        
    </div>

    <?php include_once 'views/includes/footer.php'?>

</body>
</html>

 <!-- CONTENU -->
    <!-- formulaire de connexion -->
   