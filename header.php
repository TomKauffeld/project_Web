<?php require_once __DIR__."/ressources/scripts/blog_api.php";?>
    
    
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Near from keyboard</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    
    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    
    <link rel="stylesheet" href="ressources/css/login.css">
    <link rel="stylesheet" href="ressources/css/style.css">
    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="ressources/scripts/utils.js"></script>
    <script type="text/javascript" src="ressources/scripts/blog_api.js"></script>
    <script type="text/javascript" src="ressources/scripts/page_header.js"></script>
    <script type="text/javascript">
        var time_offset = getCookie( "time_offset");
        var timezone_offset_minutes = new Date().getTimezoneOffset();
        timezone_offset_minutes = timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes;
        setCookie( "time_offset", timezone_offset_minutes, 31);
        if (time_offset == ""){
            location.reload();
        }
    </script>
</head>
<body>
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Near from keyboard</a>
            </div>
            
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav" id="nav_categories">
                    <?php
                        foreach ($categories as $key => $value) {
                            echo '<li><a href="categorie.php?c='.htmlentities($key).'">'.htmlspecialchars($value["name"]).'</a></li>';
                        }
                    ?>
                </ul>
                
                <ul id="not_logged_in" class="nav navbar-nav navbar-right">
                    <script type="text/javascript">$("#not_logged_in").hide()</script>
                    <li><a href="#" onclick="document.getElementById('login_page').style.display='block'">Se connecter</a></li>
                    <li><a href="#" onclick="document.getElementById('create_page').style.display='block'">Cr&eacute;er un compte</a></li>
                </ul>
                
                <ul id="logged_in" class="nav navbar-nav navbar-right">
                    <script type="text/javascript">$("#logged_in").hide()</script>
                    
                    <li><a id="logout" href="#">Se d&eacute;connecter</a></li>
                    <li><a id="welcomeMsg" href="#">Bienvenue utilisateur</a></li>
                
                </ul>
            </div>
        </div>
    </nav>
    <div id="login_page" class="w3-modal w3-display-middle">
        <div id="form_login" class="w3-col s12 m7 l3 w3-display-container w3-display-middle">
            <span onclick="document.getElementById('login_page').style.display='none'" class="w3-button w3-display-topright">&times;</span>
            <form style="color:black">
                <label for="login_username"><b>Nom d'utilisateur</b></label>
                <input autocomplete="username" id="login_username" type="text" placeholder="Entrez le nom d'utilisateur" required>
                
                <label for="login_password"><b>Mot de passe</b></label>
                <input autocomplete="password" id="login_password" type="password" placeholder="Entrez le mot de passe" required>
            </form>
            <button id="login">Se connecter</button>
        </div>
    </div>
    <div id="create_page" class="w3-modal w3-display-middle">
        <div id="form_create" class="w3-col s12 m7 l3 w3-display-container w3-display-middle">
            <span onclick="document.getElementById('create_page').style.display='none'" class="w3-button w3-display-topright">&times;</span>
            <form style="color:black">
                <label for="create_username"><b>Nom d'utilisateur</b></label>
                <input autocomplete="username" id="create_username" type="text" placeholder="Entrez le nom d'utilisateur" required>
                
                <label for="create_password"><b>Mot de passe</b></label>
                <input autocomplete="password" id="create_password" type="password" placeholder="Entrez le mot de passe" required>
                
                <label for="create_repeat"><b>Repetez le mot de passe</b></label>
                <input autocomplete="password" id="create_repeat" type="password" placeholder="Repetez le mot de passe" required>
            </form>
            <button id="create">Cr&eacute;er une nouvelle compte</button>
        </div>
    </div>