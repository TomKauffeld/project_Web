<?php include('header.php'); ?>

<h2>Catégories d'articles</h2>
<h3>Ajouter une nouvelle catégorie</h3>
    <form>
        <div class="form-group">
            <input type="text" class="form-control" id="inputCat" placeholder="Nom de la nouvelle catégorie">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </form>

<table class="table table-striped table-hover ">
    <thead>
        <tr>
            <th>Nom de la catégorie</th>
            <th>Nombre d'articles</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Nouveautés</td>
            <td>5</td>
            <td><a href="#" alt="Modifier l'article" class="icon-edit"><i class="fa fa-pencil"></i></a></td>
            <td><a href="#" alt="Supprimer l'article" class="icon-delete"><i class="fa fa-times"></i></a></td>
        </tr>
        <tr>
            <td>Tests</td>
            <td>10</td>
            <td><a href="#" alt="Modifier l'article" class="icon-edit"><i class="fa fa-pencil"></i></a></td>
            <td><a href="#" alt="Supprimer l'article" class="icon-delete"><i class="fa fa-times"></i></a></td>
        </tr>
        <tr>
            <td>Vidéos</td>
            <td>3</td>
            <td><a href="#" alt="Modifier l'article" class="icon-edit"><i class="fa fa-pencil"></i></a></td>
            <td><a href="#" alt="Supprimer l'article" class="icon-delete"><i class="fa fa-times"></i></a></td>
        </tr>
    </tbody>
</table>



<?php include('footer.php'); ?>