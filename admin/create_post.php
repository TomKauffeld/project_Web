<?php include __DIR__."/header.php";?>

<script type="text/javascript" src="./scripts/page_create_post.js"></script>
<?php //echo __DIR__ ?>
<div id="create_post">
    <script type"text/javascript">$("#create_post").hide();</script>
    <form style="color:black" action="#" method="POST">
        <label for="form_post_title"><b>Titre :</b></label>
        <input name= "form_post_title" id="form_post_title" type="text" placeholder="Entrez le titre" required><br>
        
        <label for="form_post_body"><b>Le contenu :</b></label>
        <textarea name= "form_post_body" id="form_post_body" type="edit" placeholder="Entrez le contenu" required rows=10 style="width:100%"></textarea><br>

        <label for="form_post_image"><b>Image : </b></label>
        <input name= "form_post_image" id="form_post_image" type="file" accept="image/*" required><br>

        <label for="form_post_categories"><b>Categories : </b></label>
        <select name= "form_post_categories" id="form_post_categories" multiple required size=<?php echo count($categories); ?>>
            <?php 
                foreach ($categories as $key => $value) {
                    echo '<option value="'.htmlspecialchars($key).'">'.htmlspecialchars($value["name"]).'</option>';
                }
            ?>
        </select>

    <form>
    <button id="form_post_button">Cr&eacute;er l'article</button>
</div>

<?php include __DIR__."/footer.php";?>