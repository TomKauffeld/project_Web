<?php 
    include('header.php'); 

    $offset = isset( $_COOKIE["time_offset"]) ? $_COOKIE["time_offset"] : 0;
    date_default_timezone_set(timezone_name_from_abbr("", $offset*60, false));
?>

<div class="banner-article" style="background-image: url('./ressources/images/mariokart8.jpg')"></div> <!-- Image d'en-tête de l'article -->

<main class="categorie">

    <div class="container">

        <div class="row">
            <div class="col-xs-12 content-article">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porta id mi ac finibus. Curabitur ut eros id ante lobortis iaculis. Suspendisse vulputate, urna ullamcorper euismod mollis, libero mauris commodo leo, in bibendum diam felis eget justo. Curabitur aliquet malesuada augue quis suscipit. Integer diam nisi, consequat vel tincidunt a, vehicula a odio. Donec sit amet nulla a nunc accumsan dignissim. Vivamus vitae tincidunt orci. Nullam fringilla lorem non urna fringilla, a mattis eros sollicitudin.</p>
                <p>Nullam tempus leo vel dolor congue, nec bibendum tellus ornare. Ut accumsan sagittis imperdiet. Nunc pulvinar elit ac suscipit aliquet. Quisque pulvinar ullamcorper metus, a egestas justo vulputate a. In bibendum dolor nec urna tincidunt, ut volutpat tortor mattis. Pellentesque diam lacus, porta sit amet lorem vel, egestas finibus sapien. Mauris sollicitudin eros a arcu feugiat vestibulum.</p>
                <p>Proin vel hendrerit eros. Vestibulum sed leo a velit posuere tincidunt. Nunc dapibus vel libero eu tristique. Cras cursus vehicula massa. Proin eu bibendum ligula. Curabitur sed tellus vitae risus pharetra vestibulum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vel odio turpis. Donec placerat sollicitudin turpis, id eleifend erat luctus sit amet. Aenean ultrices ante a sapien faucibus feugiat. Praesent massa mi, euismod eu eleifend a, iaculis quis leo. Cras ipsum purus, sodales et turpis vitae, interdum mollis urna. Vivamus bibendum lectus eget hendrerit accumsan.</p>
                <p>Proin sed risus blandit, gravida est eget, ultrices neque. Mauris ac nibh et est ultricies tempor. Sed a massa ut nisl cursus feugiat at eu leo. Aliquam et vehicula velit. Nunc lacinia sem mauris, in interdum purus rhoncus ut. Curabitur metus sapien, ullamcorper sed blandit in, maximus a lectus. Etiam tellus sapien, tincidunt ac egestas sed, congue vel sem. Phasellus mauris libero, pharetra id lorem vel, sollicitudin pretium odio. Donec sagittis ex id turpis sollicitudin, ac dapibus mauris porttitor. Praesent a aliquam sapien.</p>
                <p>Praesent ullamcorper arcu lacus, id iaculis felis aliquet id. Aenean risus nibh, consectetur sodales feugiat eget, suscipit ac mauris. Nullam tempus, dui eu tempus tincidunt, sapien elit dictum nisl, in aliquam velit arcu quis ex. Duis ultrices venenatis feugiat. Nullam varius nisl vel odio condimentum, in varius elit egestas. Aliquam tempor ex leo, non porttitor diam dapibus at. Donec gravida, mi non tempus egestas, odio mi volutpat tellus, semper lobortis eros mi eu ipsum.</p>

                <br/></br>
                <div class="row">
                    <div class="col-md-6"><i class="fa fa-pencil"></i> Par <a href="profil.php">Julie Latieule</a></div>
                    <div class="col-md-6 text-right"><i class="fa fa-calendar"></i> Publié le 27/04/2018</div>
                </div>
            </div>

            
        </div>

        
    </div>

    <div class="container">
        <div class="row">
            <h2 class="col-xs-12">Commentaires</h2>
        </div>

        <div class="row comments">
            <div class="col-xs-12 comment">
                <h5><a href="#">Julie Latieule</a> a écrit :</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porta id mi ac finibus. Curabitur ut eros id ante lobortis iaculis. Suspendisse vulputate, urna ullamcorper euismod mollis, libero mauris commodo leo, in bibendum diam felis eget justo. Curabitur aliquet malesuada augue quis suscipit. Integer diam nisi, consequat vel tincidunt a, vehicula a odio. Donec sit amet nulla a nunc accumsan dignissim. Vivamus vitae tincidunt orci. Nullam fringilla lorem non urna fringilla, a mattis eros sollicitudin.</p>
            </div>

            <div class="col-xs-12 comment">
                <h5><a href="#">Admin</a> a écrit :</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porta id mi ac finibus. Curabitur ut eros id ante lobortis iaculis. Suspendisse vulputate, urna ullamcorper euismod mollis, libero mauris commodo leo, in bibendum diam felis eget justo. Curabitur aliquet malesuada augue quis suscipit. Integer diam nisi, consequat vel tincidunt a, vehicula a odio. Donec sit amet nulla a nunc accumsan dignissim. Vivamus vitae tincidunt orci. Nullam fringilla lorem non urna fringilla, a mattis eros sollicitudin.</p>
            </div>

            <div class="col-xs-12 comment">
                <h5><a href="#">Un utilisateur</a> a écrit :</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porta id mi ac finibus. Curabitur ut eros id ante lobortis iaculis. Suspendisse vulputate, urna ullamcorper euismod mollis, libero mauris commodo leo, in bibendum diam felis eget justo. Curabitur aliquet malesuada augue quis suscipit. Integer diam nisi, consequat vel tincidunt a, vehicula a odio. Donec sit amet nulla a nunc accumsan dignissim. Vivamus vitae tincidunt orci. Nullam fringilla lorem non urna fringilla, a mattis eros sollicitudin.</p>
            </div>
            
        </div>

        
    </div>
</main>
<?php include('footer.php'); ?>