
<!doctype html>
<html>
<head>

    <?php include_once 'views/includes/head.php'?>

    
</head>

<body>

    <?php include_once 'views/includes/header.php'?>

    <!-- CONTENU -->
    <!-- formulaire de connexion -->
    <div class="container row mx-auto px-0" >
    <div class=" col-xl-10 mx-auto  px-0" > 
    <h2 class="text-center p-4  w-100 text-white"><img src="assets/images/connexion.png" alt="connexion" style="width:50px;"><br > connexion</h2>
    <?php echo $msg_connexion ;?>
        <form class="col-12  text-white py-4 bg-dark" method="post" enctype="multipart/form-data" >
            <div class="input-group mb-3">
                <label for="pseudo" class="col-12 pb-4 px-0">Pseudo</label>
                <input type="text" class="form-control" placeholder="Pseudo"  id="pseudo" name="pseudo">
            </div>
            <div class="input-group mb-3">
                <label for="mdp" class="col-12 pb-4 px-0">Mot de passe</label>
                <input type="password" class="form-control" placeholder="mot de passe"  id="mdp" name="mdp">
            </div>
            
            <div class="form-group ">
                <input class="btn w-100 my-3 bg-white text-dark" type="submit" value="Valider" name="connexion" id="connexion">
            </div>
            
        </form>
    </div>
    <p class='text-center py-4 col-12'><a class="text-center mx-auto " href="?page=inscription" style="font-size:1.4em">Inscription</a></p>
        
    </div>

    

    <?php include_once 'views/includes/footer.php'?>

</body>
</html>
