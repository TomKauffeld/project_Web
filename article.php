<?php 
    include('header.php'); 

    $offset = isset( $_COOKIE["time_offset"]) ? $_COOKIE["time_offset"] : 0;
    date_default_timezone_set(timezone_name_from_abbr("", $offset*60, false));
    $id = isset( $_GET["p"]) ? $_GET["p"] : "NON_DEFINI";
    $result = file_get_contents($url."post/".$id, false, $context);
    $json = json_decode( $result, true);
    $post = $json["post"];
    $result = file_get_contents($url."user/".$post["author"], false, $context);
    $json = json_decode( $result, true);
    $user = $json["user"];
?>
<?php $urlImage = "https://pubflare.ovh/school/blog/api/image/";?>
<div class="banner-article" style="background-image: url('<?php echo htmlspecialchars( $urlImage.$post["image"]);?>')"></div> <!-- Image d'en-tête de l'article -->

<main class="categorie">

    <div class="container">
        <div class="row">
            <h2 class="col-xs-12"><?php echo htmlspecialchars( $post["title"]);?></h2>
        </div>
        <div class="row">
            <div class="col-xs-12 content-article">
                <?php echo htmlspecialchars( $post["body"]);?>

                <br/></br>
                <div class="row">
                    <div class="col-md-6"><i class="fa fa-pencil"></i> Par <a href="profil.php?u=<?php echo htmlspecialchars($user["id"]);?>"><?php echo htmlspecialchars($user["username"]);?></a></div>
                    <div class="col-md-6 text-right"><i class="fa fa-calendar"></i> Publié le <?php echo htmlspecialchars( date( "d/m/y", $post["time"]));?></div>
                </div>
            </div>

            
        </div>

        
    </div>

    <div class="container">
        <div class="row">
            <h2 class="col-xs-12">Commentaires</h2>
        </div>

        <div class="row comments">
            <div class="col-xs-12 comment">
                <h5><a href="#">Julie Latieule</a> a écrit :</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porta id mi ac finibus. Curabitur ut eros id ante lobortis iaculis. Suspendisse vulputate, urna ullamcorper euismod mollis, libero mauris commodo leo, in bibendum diam felis eget justo. Curabitur aliquet malesuada augue quis suscipit. Integer diam nisi, consequat vel tincidunt a, vehicula a odio. Donec sit amet nulla a nunc accumsan dignissim. Vivamus vitae tincidunt orci. Nullam fringilla lorem non urna fringilla, a mattis eros sollicitudin.</p>
            </div>

            <div class="col-xs-12 comment">
                <h5><a href="#">Admin</a> a écrit :</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porta id mi ac finibus. Curabitur ut eros id ante lobortis iaculis. Suspendisse vulputate, urna ullamcorper euismod mollis, libero mauris commodo leo, in bibendum diam felis eget justo. Curabitur aliquet malesuada augue quis suscipit. Integer diam nisi, consequat vel tincidunt a, vehicula a odio. Donec sit amet nulla a nunc accumsan dignissim. Vivamus vitae tincidunt orci. Nullam fringilla lorem non urna fringilla, a mattis eros sollicitudin.</p>
            </div>

            <div class="col-xs-12 comment">
                <h5><a href="#">Un utilisateur</a> a écrit :</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porta id mi ac finibus. Curabitur ut eros id ante lobortis iaculis. Suspendisse vulputate, urna ullamcorper euismod mollis, libero mauris commodo leo, in bibendum diam felis eget justo. Curabitur aliquet malesuada augue quis suscipit. Integer diam nisi, consequat vel tincidunt a, vehicula a odio. Donec sit amet nulla a nunc accumsan dignissim. Vivamus vitae tincidunt orci. Nullam fringilla lorem non urna fringilla, a mattis eros sollicitudin.</p>
            </div>
            
        </div>

        
    </div>
</main>
<?php include('footer.php'); ?>