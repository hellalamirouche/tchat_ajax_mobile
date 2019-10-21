<!-- Meta Tags -->
<meta charset="UTF-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=0, maximum-scale=1, initial-scale=1.0, maximum-scale=1">
<meta name="author" content="<?= WEBSITE_AUTHOR?>">
<meta name="description" content="<?= WEBSITE_DESCRIPTION?>" />
<meta name=”keywords” content="<?= WEBSITE_KEYWORDS?>"/>
<meta name="Reply-to" content="<?= WEBSITE_AUTHOR_MAIL?>">
<meta name="Copyright" content="<?= WEBSITE_AUTHOR?>">
<meta name="Language" content="<?= WEBSITE_LANGUAGE?>">


<!-- Open Graph tags -->
<meta property="og:type"              content="website" />
<meta property="og:url"               content="<?= WEBSITE_FACEBOOK_URL?>" />
<meta property="og:title"             content="<?= WEBSITE_FACEBOOK_NAME?>" />
<meta property="og:description"       content="<?= WEBSITE_FACEBOOK_DESCRIPTION?>" />
<meta property="og:image"             content="<?= WEBSITE_FACEBOOK_IMAGE?>" />

<!-- titre du site -->
<title><?= ucfirst($page).' ' .WEBSITE_TITLE ?></title>




<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">



 <!-- fontawsome -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
 <!-- bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
   <!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="assets/styles/css/chat.css"> 
 
<!-- javascript -->
<!-- il faut mettre jquerry en haut sinon ca ne fonctionne pas javasvript de bootstrap -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
<!-- push.js pour les notifications  -->
<script src="assets/js/push.js"></script>
<script src="assets/js/serviceWorker.min.js"></script>