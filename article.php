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
            <?php
            $result = file_get_contents($url."post/".$id."/comments", false, $context);
            $json = json_decode( $result, true);
            $comments = $json["comments"];
            foreach( $comments as $cid){
                $result = file_get_contents($url."comment/".$cid, false, $context);
                $json = json_decode( $result, true);
                $comment = $json["comment"];
                $result = file_get_contents( $url."user/".$comment["author"], false, $context);
                $json = json_decode( $result, true);
                $user = $json["user"];
                echo '<div class="col-xs-12 comment">';
                echo '<h5>Le '.htmlspecialchars( date( "d/m/y", $post["time"])).', <a href="profil.php?u='.htmlspecialchars($user["id"]).'">'.htmlspecialchars($user["username"]).'</a> a écrit :</h5>';
                echo '<p>'.htmlspecialchars( $comment["body"]).'</p></div>';
            }


            ?>
        </div>
        
    </div>

    <div class="container">
        <div class="row">
            <h2 class="col-xs-12">Votre commentaire</h2>
        </div>

        <div class="row">
            <form class="form-horizontal col-md-8 col-md-offset-2">
            <input id="id" type="hidden" value="<?php echo htmlspecialchars( $id);?>">
            <br/>
                <div class="form-group">
                    <textarea id="comment_body" class="form-control" rows="3"></textarea>
                </div>
                
                <button type="reset" class="btn btn-default">Annuler</button>
                <button id="send_comment" type="button" class="btn btn-primary">Envoyer</button> 
            </form>
        <div>
    </div>
</main>
<script type="text/javascript">
    $(document).ready( function(){
        $("#send_comment").click( function(){
            var sendData = {
                "post": $("#id").val(),
                "body": $("#comment_body").val(),
                "token": JSON.parse(getToken())
            }
            var sendString = JSON.stringify( sendData);
            send( "https://pubflare.ovh/school/blog/api/latest/comment", "POST", sendString, function( json){
                if (json.status == "OK"){
                    location.reload();
                }else{
                    alert( json.error);
                }
            });
        })
    });

</script>
<?php include('footer.php'); ?>