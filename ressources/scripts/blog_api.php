<?php
$url = "https://pubflare.ovh/school/blog/api/latest/";
$options = array( 
    "http" => array( 
        "header"  => "Content-Type: application/x-www-form-urlencoded\r\n",
        "method"  => "GET"
        )
    );
$context = stream_context_create( $options);
$result = file_get_contents($url."category", false, $context);
$json = json_decode( $result, true);
$categories = array();
if ($json["status"] == "OK"){
    foreach ($json["categories"] as $id ) {
        $result = file_get_contents( $url."category/".$id, false, $context);
        $category = json_decode( $result, true);
        $categories[$category["category"]["id"]] = $category["category"];
    }
}
else{
    echo "ERROR";
}


?>