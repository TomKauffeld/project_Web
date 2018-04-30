<?php include('header.php'); ?>

<script type="text/javascript" src="js/page_categories.js"></script>
<h2>Catégories d'articles</h2>
<h3>Ajouter une nouvelle catégorie</h3>
    <form>
        <div class="form-group">
            <input type="text" class="form-control" id="inputCat" placeholder="Nom de la nouvelle catégorie">
        </div>
    </form>

        <button class="btn btn-primary" id="addCategorie">Ajouter</button>
<table class="table table-striped table-hover ">
    <thead>
        <tr>
            <th>Nom de la catégorie</th>
            <th>Nombre d'articles</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody id="list_categories">
    </tbody>
</table>



<?php include('footer.php'); ?>