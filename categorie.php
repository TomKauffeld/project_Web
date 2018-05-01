<?php 
    include('header.php'); 

    $offset = isset( $_COOKIE["time_offset"]) ? $_COOKIE["time_offset"] : 0;
    date_default_timezone_set(timezone_name_from_abbr("", $offset*60, false));

    $id = isset( $_GET["c"]) ? $_GET["c"] : "NON_DEFINIE";
    $result = file_get_contents($url."category/".$id, false, $context);
    $json = json_decode( $result, true);
    $category = $json["category"];
    $result = file_get_contents($url."category/".$id."/posts", false, $context);
    $json = json_decode( $result, true);
    $postIds = $json["posts"];
?>

<main>


    <div class="container">
        <div class="row">
            <h2 class="col-xs-12"><?php echo htmlspecialchars($category["name"]); ?></h2>
        </div>
        <?php
        $urlImage = "https://pubflare.ovh/school/blog/api/image/";
        foreach ($postIds as $id) {
            $result = file_get_contents( $url."post/".$id, false, $context);
            $post = json_decode( $result, true);
            $post = $post["post"];
            $result = file_get_contents( $url."post/".$id."/comments", false, $context);
            $json = json_decode( $result, true);
            $comments = $json["lenght"];
            $result = file_get_contents($url."user/".$post["author"], false, $context);
            $user = json_decode( $result, true);
            $user = $user["user"];
            echo '<div class="row home-article">';
            echo '<div class="image" style="background-image: url(\''.$urlImage.$post["image"].'\')"></div>';
            echo '<div class="resume">';
            echo '<h3><a href="article.php?p='.htmlspecialchars($id).'">'.htmlspecialchars($post["title"]).'</a></h3>';
            echo '<p>'.htmlspecialchars( $post["body"])."</p>";
            echo "<div class='row'>";
            echo '<div class="col-md-6"><i class="fa fa-calendar"></i> Publié le '.date( "d/m/y", $post["time"]).'</div>';
            echo '<div class="col-md-6"><i class="fa fa-pencil"></i> Auteur : <a href="profil.php?u='.htmlspecialchars($user["id"]).'">'.htmlspecialchars($user["username"]).'</a></div>';
            echo '<div class="col-xs-12"><i class="fa fa-comments"></i> '.htmlspecialchars( $comments).' commentaires</div>';
            echo '</div></div></div>';
        }
        ?>
    </div>
</main>
<?php include('footer.php'); ?>