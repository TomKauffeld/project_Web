<?php include __DIR__."/header.php"; ?>
<link rel="stylesheet" href="css/login.css">
<script type="text/javascript">
    $("#button_login").empty();
    $("#button_create").show();
    $("#button_deco").empty();
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form>
                <h3>Connection</h3>
                <label for="form_login_username"><b>Nom d'utilisateur</b></label>
                <input autocomplete="username" id="form_login_username" type="text" placeholder="Entrez le nom d'utilisateur" required>

                <label for="form_login_password"><b>Mot de passe</b></label>
                <input autocomplete="password" id="form_login_password" type="password" placeholder="Entrez le mot de passe" required>
            </form>
            <button id="form_login_button" onclick="form_login()">Se connecter</button>
        </div>
    </div>
</div>



<?php include __DIR__."/footer.php"; ?>