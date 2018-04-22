<?php include __DIR__."/header.php";?>

<script type="text/javascript" src="ressources/scripts/page_create_post.js"></script>

<div id="create_post">
    <script type"text/javascript">$("#create_post").hide();</script>
    <form style="color:black">
        <label for="form_post_title"><b>Titre :</b></label>
        <input name= "form_post_title" id="form_post_title" type="text" placeholder="Entrez le titre" required><br>
        
        <label for="form_post_body"><b>Le contenu :</b></label>
        <textarea name= "form_post_body" id="form_post_body" type="edit" placeholder="Entrez le contenu" required rows=10 style="width:100%"></textarea><br>

        <label for="form_post_image"><b>Image : </b></label>
        <input name= "form_post_image" id="form_post_image" type="file" accept="image/*"><br>

        <label for="form_post_categories"><b>Categories : </b></label>
        <select name= "form_post_categories" id="form_post_categories">

        </select>

    <form>

</div>

<?php include __DIR__."/footer.php";?>