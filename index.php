<?php include('header.php');
$offset = isset( $_COOKIE["time_offset"]) ? $_COOKIE["time_offset"] : 0;
date_default_timezone_set(timezone_name_from_abbr("", $offset*60, false));
?>

<div class="banner-home"></div>

<main> 
    <div class="container">
        <div class="row">
            <h2 class="col-xs-12">Les derniers articles</h2>
        </div>
        <?php
            $url = "https://pubflare.ovh/school/blog/api/latest/post/";
            $options = array( 
                "http" => array( 
                    "header"  => "Content-Type: application/x-www-form-urlencoded\r\n",
                    "method"  => "GET"
                    )
                );
                $context = stream_context_create( $options);
                $result = file_get_contents($url."?limit=3", false, $context);
                $json = json_decode( $result, true);
                $posts = array();
                if ($json["status"] == "OK"){
                    foreach ($json["posts"] as $id ) {
                        $result = file_get_contents( $url.$id, false, $context);
                        $post = json_decode( $result, true);
                        $result = file_get_contents( $url.$id."/comments/", false, $context);
                        $comments = json_decode( $result, true);
                        $posts[$post["post"]["id"]] = $post["post"];
                        $posts[$post["post"]["id"]]["comments"] = $comments["lenght"];
                    }
                }
                $url = "https://pubflare.ovh/school/blog/api/image/";
                foreach ($posts as $id => $post) {
                    echo '<div class="row home-article">';
                    echo '<div class="image" style="background-image: url(\''.$url.$post["image"].'\')"></div>';
                    echo '<div class="resume">';
                    echo '<h3><a href="#">'.htmlspecialchars($post["title"]).'</a></h3>';
                    echo '<p>'.htmlspecialchars( $post["body"])."</p>";
                    echo "<div class='row'>";
                    echo '<div class="col-md-6"><i class="fa fa-calendar"></i> Publié le '.date( "d/m/y", $post["time"]).'</div>';
                    echo '<div class="col-md-6"><i class="fa fa-pencil"></i> Auteur : <a href="#">Julie Latieule</a></div>';
                    echo '<div class="col-xs-12"><i class="fa fa-comments"></i> '.htmlspecialchars( $post["comments"]).' commentaires</div>';
                    echo '</div></div></div>';
                }
        
        ?>
    </div>

    <div class="container">
        <div class="row">
            <h2 class="col-xs-12">Articles les plus commentés</h2>
        </div>

        <div class="row home-article">
            <div class="image" style="background-image: url('ressources/images/monsterhunterworld.jpg')"></div>

            <div class="resume">
                <h3><a href="#">Titre de l'article</a></h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur facilisis, eros ut varius commodo, diam nunc tincidunt ante, vel congue augue urna et elit. Duis ullamcorper et risus a sagittis. </p>
                <div class='row'>
                    <div class="col-md-6"><i class="fas fa-calendar-alt"></i> Publié le 17/04/2018</div>
                    <div class="col-md-6"><i class="fas fa-pencil-alt"></i> Auteur : <a href="#">Julie Latieule</a></div>
                    <div class="col-xs-12"><i class="far fa-comments"></i> 5 commentaires</div>
                </div>
            </div>
        </div>

        <div class="row home-article">
            <div class="image" style="background-image: url('ressources/images/mariokart8.jpg')"></div>

            <div class="resume">
                <h3><a href="#">Titre de l'article</a></h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur facilisis, eros ut varius commodo, diam nunc tincidunt ante, vel congue augue urna et elit. Duis ullamcorper et risus a sagittis. </p>
                <div class='row'>
                    <div class="col-md-6"><i class="fas fa-calendar-alt"></i> Publié le 17/04/2018</div>
                    <div class="col-md-6"><i class="fas fa-pencil-alt"></i> Auteur : <a href="#">Julie Latieule</a></div>
                    <div class="col-xs-12"><i class="far fa-comments"></i> 5 commentaires</div>
                </div>
            </div>
        </div>

        <div class="row home-article">
            <div class="image" style="background-image: url('ressources/images/fortnite.jpg')"></div>

            <div class="resume">
                <h3><a href="#">Titre de l'article</a></h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur facilisis, eros ut varius commodo, diam nunc tincidunt ante, vel congue augue urna et elit. Duis ullamcorper et risus a sagittis. </p>
                <div class='row'>
                    <div class="col-md-6"><i class="fas fa-calendar-alt"></i> Publié le 17/04/2018</div>
                    <div class="col-md-6"><i class="fas fa-pencil-alt"></i> Auteur : <a href="#">Julie Latieule</a></div>
                    <div class="col-xs-12"><i class="far fa-comments"></i> 5 commentaires</div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include('footer.php') ; ?>