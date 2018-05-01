<?php 
include('header.php'); 

$offset = isset( $_COOKIE["time_offset"]) ? $_COOKIE["time_offset"] : 0;
date_default_timezone_set(timezone_name_from_abbr("", $offset*60, false));


$id = isset( $_GET["u"]) ? $_GET["u"] : "NON_DEFINIE";
$result = file_get_contents($url."user/".$id, false, $context);
$json = json_decode( $result, true);


?>

<div class="banner-article" style="background-image: url('./ressources/images/mariokart8.jpg')"></div> <!-- Image d'en-tête de l'article -->

<main class="categorie">
    <?php
        if ($json["status"] == "OK"){
            $user = $json["user"];
            $name = $user["username"];
            $result = file_get_contents($url."user/".$id."/posts", false, $context);
            $json = json_decode( $result, true);
            $nbposts = $json["lenght"];
            $result = file_get_contents($url."user/".$id."/comments", false, $context);
            $json = json_decode( $result, true);
            $nbcomments = $json["lenght"];

            $result = file_get_contents($url."user/".$id."/posts?limit=3", false, $context);
            $json = json_decode( $result, true);
            $posts = $json["posts"];
            $result = file_get_contents($url."user/".$id."/comments?limit=3", false, $context);
            $json = json_decode( $result, true);
            $comments = $json["comments"];
        }else{
            echo "<div class='container'><div class='row'><h2 class='col-xs-12'>L'utilisateur ".htmlspecialchars($id)." n'est pas trouvé</h2></div></div>"; 
            echo "</main>";
            include('footer.php');
            exit;
        }

    ?>

    <div class="container">
        <div class="row">
            <h2 class="col-xs-12"><?php echo htmlspecialchars( $name);?></h2>
        </div>
        <div class="row">
            <div class="col-xs-12 content-article">
                <p><i class="fa fa-user"></i> <?php echo htmlspecialchars( $name);?></p>
                <?php 
                    if ($user["adminLvL"] >= 1 || $nbposts > 0){
                        echo '<p><i class="fa fa-pencil"></i> '.htmlspecialchars( $nbposts).' articles</p>';
                    }
                ?>
                <p><i class="fa fa-comment"></i> <?php echo htmlspecialchars( $nbcomments);?> commentaires</p>
            </div>

            
        </div>

        
    </div>

    <?php
        if ($nbcomments > 0){
            echo '<div class="container"><div class="row"><h2 class="col-xs-12">Derniers commentaires</h2></div><div class="row comments">';
            foreach( $comments as $id){
                $result = file_get_contents($url."comment/".$id, false, $context);
                $comment = json_decode( $result, true);
                $comment = $comment["comment"];
                $result = file_get_contents($url."post/".$comment["post"], false, $context);
                $post = json_decode( $result, true);
                $post = $post["post"];
                echo '<div class="col-xs-12 comment"><h5><a href="article.php?p='.htmlspecialchars($post["id"]).'">';
                echo htmlspecialchars( $post["title"]);
                echo '</a></h5><p>';
                echo htmlspecialchars( $comment["body"]);
                echo "</p></div>";
            }
            echo "</div></div>";
        }
        if ($nbposts > 0){
            echo '<div class="container"><div class="row"><h2 class="col-xs-12">Derniers articles</h2></div>';
            foreach( $posts as $id){
                $result = file_get_contents($url."post/".$id, false, $context);
                $post = json_decode( $result, true);
                $post = $post["post"];
                echo '<div class="col-xs-12 comment"><h5><a href="article.php?p='.htmlspecialchars($post["id"]).'">';
                echo htmlspecialchars( $post["title"]);
                echo '</a></h5><p>';
                echo htmlspecialchars( $post["body"]);
                echo "</p></div>";
            }
        }
        echo "</div></div>";
    ?>
</main>
<?php include('footer.php'); ?>