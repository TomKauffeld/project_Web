<?php 
    include('header.php'); 

    $offset = isset( $_COOKIE["time_offset"]) ? $_COOKIE["time_offset"] : 0;
    date_default_timezone_set(timezone_name_from_abbr("", $offset*60, false));

    $id = isset( $_GET["c"]) ? $_GET["c"] : "NON_DEFINIE";
    $result = file_get_contents($url."category/".$id, false, $context);
    $json = json_decode( $result, true);
    $category = $json["category"];
?>

<main>


    <div class="container">
        <div class="row">
            <h2 class="col-xs-12"><?php echo htmlspecialchars($category["name"]); ?></h2>
        </div>

        <div class="row home-article">
            <div class="image" style="background-image: url('ressources/images/monsterhunterworld.jpg')"></div>

            <div class="resume">
                <h3><a href="#">Titre de l'article</a></h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur facilisis, eros ut varius commodo, diam nunc tincidunt ante, vel congue augue urna et elit. Duis ullamcorper et risus a sagittis. </p>
                <div class='row'>
                    <div class="col-md-6"><i class="fa fa-calendar"></i> Publié le 17/04/2018</div>
                    <div class="col-md-6"><i class="fa fa-pencil"></i> Auteur : <a href="#">Julie Latieule</a></div>
                    <div class="col-xs-12"><i class="fa fa-comments"></i> 5 commentaires</div>
                </div>
            </div>
        </div>

        <div class="row home-article">
            <div class="image" style="background-image: url('ressources/images/mariokart8.jpg')"></div>

            <div class="resume">
                <h3><a href="#">Titre de l'article</a></h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur facilisis, eros ut varius commodo, diam nunc tincidunt ante, vel congue augue urna et elit. Duis ullamcorper et risus a sagittis. </p>
                <div class='row'>
                    <div class="col-md-6"><i class="fa fa-calendar"></i> Publié le 17/04/2018</div>
                    <div class="col-md-6"><i class="fa fa-pencil"></i> Auteur : <a href="#">Julie Latieule</a></div>
                    <div class="col-xs-12"><i class="fa fa-comments"></i> 5 commentaires</div>
                </div>
            </div>
        </div>

        <div class="row home-article">
            <div class="image" style="background-image: url('ressources/images/fortnite.jpg')"></div>

            <div class="resume">
                <h3><a href="#">Titre de l'article</a></h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur facilisis, eros ut varius commodo, diam nunc tincidunt ante, vel congue augue urna et elit. Duis ullamcorper et risus a sagittis. </p>
                <div class='row'>
                    <div class="col-md-6"><i class="fa fa-calendar"></i> Publié le 17/04/2018</div>
                    <div class="col-md-6"><i class="fa fa-pencil"></i> Auteur : <a href="#">Julie Latieule</a></div>
                    <div class="col-xs-12"><i class="fa fa-comments"></i> 5 commentaires</div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include('footer.php'); ?>