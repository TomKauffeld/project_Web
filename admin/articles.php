<?php include('header.php') ; ?>

<script type="text/javascript" src="scripts/page_articles.js"></script>
<h2>Gestion des articles <a class="btn btn-primary" href="create_post.php">Ajouter un nouvel article</a></h2>
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>Titre de l'article</th>
      <th>Auteur</th>
      <th>Date</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody id="list_posts">
  </tbody>
</table> 

<?php include('footer.php') ;?>