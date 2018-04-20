<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Near from keyboard</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!-- Styles -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/header_login.js"></script>
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
                <ul class="nav navbar-nav">
                    <li><a href="#">Actualités</a></li>
                    <li><a href="#">Tests</a></li>
                    <li><a href="#">Vidéo</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li                       id="button_login" ><a href="connection" >Connexion   </a></li>
                    <li                       id="button_create"><a href="inscription">Inscription </a></li>
                    <li onclick="menu_deco()" id="button_deco"  ><a href="#"          >Deconnection</a></li>
                </ul>
            </div>
        </div>
    </nav>
</body>