<?php include __DIR__."/header.php";?>

<script type="text/javascript" src="./scripts/page_create_post.js"></script>
<?php //echo __DIR__ ?>
<h2>Écrire un nouvel article</h2>
<div id="create_post">
    <script type"text/javascript">$("#create_post").hide();</script>
    <form style="color:black" action="#" method="POST">
        <label for="form_post_title"><b>Titre de l'article</b></label>
        <input name= "form_post_title" id="form_post_title" class="form-control" type="text" placeholder="Entrez le titre" required><br>
        
        <label for="form_post_body"><b>Contenu</b></label>
        <textarea name= "form_post_body" id="form_post_body" class="form-control" type="edit" placeholder="Entrez le contenu" required rows=10 style="width:100%"></textarea><br>

        <label for="form_post_image"><b>Image d'en-tête </b></label>
        <input name= "form_post_image" id="form_post_image" type="file" accept="image/*" required><br>

        <label for="form_post_categories"><b>Catégories : </b></label>
        <select name= "form_post_categories" id="form_post_categories" class="form-control" multiple required size=<?php echo count($categories); ?>>
            <?php 
                foreach ($categories as $key => $value) {
                    echo '<option value="'.htmlspecialchars($key).'">'.htmlspecialchars($value["name"]).'</option>';
                }
            ?>
        </select>
    </form>
    <br/>
    <button id="form_post_button" class="btn btn-primary">Publier sur le blog</button>
</div>

<?php include __DIR__."/footer.php";?>