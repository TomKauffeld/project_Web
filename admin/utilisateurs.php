<?php include('header.php'); ?>

<h2>Gestion des utilisateurs</h2>

<table class="table table-striped table-hover ">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Adresse mail</th>
            <th>Rôle</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Julie Latieule</td>
            <td>julie@julie.ca</td>
            <td>Administrateur</td>
            <td><a href="#" alt="Modifier l'article" class="icon-edit"><i class="fa fa-pencil"></i></a></td>
            <td><a href="#" alt="Supprimer l'article" class="icon-delete"><i class="fa fa-times"></i></a></td>
        </tr>
        <tr>
            <td>Jean Tremblay</td>
            <td>jean@jean.ca</td>
            <td>Membre</td>
            <td><a href="#" alt="Modifier l'article" class="icon-edit"><i class="fa fa-pencil"></i></a></td>
            <td><a href="#" alt="Supprimer l'article" class="icon-delete"><i class="fa fa-times"></i></a></td>
        </tr>
        <tr>
            <td>Matthieu Gagnon</td>
            <td>mat@mat.ca</td>
            <td>Auteur</td>
            <td><a href="#" alt="Modifier l'article" class="icon-edit"><i class="fa fa-pencil"></i></a></td>
            <td><a href="#" alt="Supprimer l'article" class="icon-delete"><i class="fa fa-times"></i></a></td>
        </tr>
    </tbody>
</table>



<?php include('footer.php'); ?>