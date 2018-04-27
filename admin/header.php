<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Panneau d'administration - Near from Keyboard</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    
    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style.css">
    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!--<script type="text/javascript" src="ressources/scripts/utils.js"></script>
    <script type="text/javascript" src="ressources/scripts/blog_api.js"></script>
    <script type="text/javascript" src="ressources/scripts/page_header.js"></script>-->
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
<body class="container-fluid">
    <div class="row">
        <nav class="nav-admin col-md-3 col-lg-2">
            <h1>Near from keyboard</h1>
            <ul>
                <li><a href="."><i class="fa fa-cog"></i> Panneau d'administration</a></li>
                <li><a href="./articles.php"><i class="fa fa-file-text"></i>  Articles</a></li>
                <li><a href="./categories.php"><i class="fa fa-list"></i> Catégories</a></li>
                <li><a href="./utilisateurs.php"><i class="fa fa-user"></i> Utilisateurs</a></li>
                <li><a href="./commentaires.php"><i class="fa fa-comment"></i> Commentaires</a></li>
            </ul>
            <p class="retour-blog">
                <a href=".."><i class="fa fa-sign-out"></i> Retour au blog</a>
            </p>
        </nav>

        <main class="col-md-9 col-lg-10">