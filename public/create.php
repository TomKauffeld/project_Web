<?php include __DIR__."/header.php"; ?>
<link rel="stylesheet" href="css/login.css">
<script type="text/javascript">
    $("#button_login").show();
    $("#button_create").empty();
    $("#button_deco").empty();
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form>
                <h3>Inscription</h3>
                <label for="form_create_username"><b>Nom d'utilisateur</b></label>
                <input autocomplete="username" id="form_create_username" type="text" placeholder="Entrez le nom d'utilisateur" required>

                <label for="form_create_password"><b>Mot de passe</b></label>
                <input autocomplete="password" id="form_create_password" type="password" placeholder="Entrez le mot de passe" required>

                <label for="form_create_repeat"><b>Repetez le mot de passe</b></label>
                <input autocomplete="password" id="form_create_repeat" type="password" placeholder="Repetez le mot de passe" required>
            </form>
            <button id="form_create_button" onclick="form_create()">S'inscrire</button>
        </div>
    </div>
</div>



<?php include __DIR__."/footer.php"; ?>