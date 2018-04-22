verifyToken( 
    function(){
        updateUser( function(){
            if (getAdminLvL()>=1){
                updateCategories( function( ){
                    $(document).ready( function( ){
                        var categories = getCategories();
                        $("#form_post_categories").attr( "size", getNbCategories());
                        categories.forEach(category => {
                            $("#form_post_categories").append( '<option value="' + category.id + '">' + category.name + '</option>');
                        });


                        $("#create_post").show();
                    });
                });
            }
        });
    }
);