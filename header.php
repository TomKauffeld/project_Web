<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Near from keyboard</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!-- Styles -->
    <link rel="stylesheet" href="ressources/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="ressources/css/login.css">
    <link rel="stylesheet" href="ressources/css/style.css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
                <a class="navbar-brand" href="#">Near from keyboard</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="#">Actualités</a></li>
                    <li><a href="#">Tests</a></li>
                    <li><a href="#">Vidéo</a></li>
                </ul>

                <ul id="not_logged_in" class="nav navbar-nav navbar-right w3-row">
                    <script type="text/javascript">$("#not_logged_in").hide()</script>
                    <li><button type="button" class="w3-button" onclick="document.getElementById('login_page').style.display='block'">Se connecter</button></li>
                    <li><button type="button" class="w3-button" onclick="document.getElementById('create_page').style.display='block'">Cr&eacute;er un compte</button></li>

                    <div id="login_page" class="w3-modal w3-display-middle">
                        <div id="form_login" class="w3-col s12 m7 l3 w3-display-container w3-display-middle">
                            <span onclick="document.getElementById('login_page').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                            <form>
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
                            <form>
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
                </ul>

                <ul id="logged_in" class="nav navbar-nav navbar-right">
                    <script type="text/javascript">$("#logged_in").hide()</script>

                    <li><button id="logout" class="w3-button">Se d&eacute;connecter</button></li>
                    <li><span id="welcomeMsg">Bienvenue utilisateur</span></li>

                </ul>
            </div>
        </div>
    </nav>