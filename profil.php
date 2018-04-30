<?php 
    include('header.php'); 

    $offset = isset( $_COOKIE["time_offset"]) ? $_COOKIE["time_offset"] : 0;
    date_default_timezone_set(timezone_name_from_abbr("", $offset*60, false));
?>

<div class="banner-article" style="background-image: url('./ressources/images/mariokart8.jpg')"></div> <!-- Image d'en-tête de l'article -->

<main class="categorie">

    <div class="container">
        <div class="row">
            <h2 class="col-xs-12">Nom du membre</h2>
        </div>
        <div class="row">
            <div class="col-xs-12 content-article">
                <p><i class="fa fa-user"></i> Nom du membre</p>
                <p><i class="fa fa-pencil"></i> 5 articles</p>
                <p><i class="fa fa-comment"></i> 88 commentaires</p>
            </div>

            
        </div>

        
    </div>

    <div class="container">
        <div class="row">
            <h2 class="col-xs-12">Derniers commentaires</h2>
        </div>

        <div class="row comments">
            <div class="col-xs-12 comment">
                <h5><a href="#">Nom de l'article</a></h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porta id mi ac finibus. Curabitur ut eros id ante lobortis iaculis. Suspendisse vulputate, urna ullamcorper euismod mollis, libero mauris commodo leo, in bibendum diam felis eget justo. Curabitur aliquet malesuada augue quis suscipit. Integer diam nisi, consequat vel tincidunt a, vehicula a odio. Donec sit amet nulla a nunc accumsan dignissim. Vivamus vitae tincidunt orci. Nullam fringilla lorem non urna fringilla, a mattis eros sollicitudin.</p>
            </div>

            <div class="col-xs-12 comment">
                <h5><a href="#">Nom de l'article</a></h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porta id mi ac finibus. Curabitur ut eros id ante lobortis iaculis. Suspendisse vulputate, urna ullamcorper euismod mollis, libero mauris commodo leo, in bibendum diam felis eget justo. Curabitur aliquet malesuada augue quis suscipit. Integer diam nisi, consequat vel tincidunt a, vehicula a odio. Donec sit amet nulla a nunc accumsan dignissim. Vivamus vitae tincidunt orci. Nullam fringilla lorem non urna fringilla, a mattis eros sollicitudin.</p>
            </div>

            <div class="col-xs-12 comment">
                <h5><a href="#">Nom de l'article</a></h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porta id mi ac finibus. Curabitur ut eros id ante lobortis iaculis. Suspendisse vulputate, urna ullamcorper euismod mollis, libero mauris commodo leo, in bibendum diam felis eget justo. Curabitur aliquet malesuada augue quis suscipit. Integer diam nisi, consequat vel tincidunt a, vehicula a odio. Donec sit amet nulla a nunc accumsan dignissim. Vivamus vitae tincidunt orci. Nullam fringilla lorem non urna fringilla, a mattis eros sollicitudin.</p>
            </div>
            
        </div>        
    </div>

    <div class="container">
        <div class="row">
            <h2 class="col-xs-12">Derniers articles</h2>
        </div>

        <div class="row comments">
            <div class="col-xs-12 comment">
                <h5><a href="#">Nom de l'article</a></h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porta id mi ac finibus. Curabitur ut eros id ante lobortis iaculis. Suspendisse vulputate, urna ullamcorper euismod mollis, libero mauris commodo leo, in bibendum diam felis eget justo. Curabitur aliquet malesuada augue quis suscipit. Integer diam nisi, consequat vel tincidunt a, vehicula a odio. Donec sit amet nulla a nunc accumsan dignissim. Vivamus vitae tincidunt orci. Nullam fringilla lorem non urna fringilla, a mattis eros sollicitudin.</p>
            </div>

            <div class="col-xs-12 comment">
                <h5><a href="#">Nom de l'article</a></h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porta id mi ac finibus. Curabitur ut eros id ante lobortis iaculis. Suspendisse vulputate, urna ullamcorper euismod mollis, libero mauris commodo leo, in bibendum diam felis eget justo. Curabitur aliquet malesuada augue quis suscipit. Integer diam nisi, consequat vel tincidunt a, vehicula a odio. Donec sit amet nulla a nunc accumsan dignissim. Vivamus vitae tincidunt orci. Nullam fringilla lorem non urna fringilla, a mattis eros sollicitudin.</p>
            </div>

            <div class="col-xs-12 comment">
                <h5><a href="#">Nom de l'article</a></h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porta id mi ac finibus. Curabitur ut eros id ante lobortis iaculis. Suspendisse vulputate, urna ullamcorper euismod mollis, libero mauris commodo leo, in bibendum diam felis eget justo. Curabitur aliquet malesuada augue quis suscipit. Integer diam nisi, consequat vel tincidunt a, vehicula a odio. Donec sit amet nulla a nunc accumsan dignissim. Vivamus vitae tincidunt orci. Nullam fringilla lorem non urna fringilla, a mattis eros sollicitudin.</p>
            </div>
            
        </div>        
    </div>
</main>
<?php include('footer.php'); ?>