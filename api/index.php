
<?php
    $url = "https://pubflare.ovh/school/blog/api/latest";
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'GET',
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { /* Handle error */ }

    $json = json_decode( $result, true);
?>
<html>
    <head>
        <title>Blog api</title>
    </head>
    <body>
        
        <h1 id="top">The API for the blog website</h1>
        current version : <?php echo htmlspecialchars( $json["version"]);?><br>
        api link : <a href="https://pubflare.ovh/school/blog/api/latest/">https://pubflare.ovh/school/blog/api/latest</a> for the latest version<br>
        or instead of /api/latest you can select your version by going to /api/{api version} <br>
        to know which version you are using, check the "version" tag inside the responses<br>
        All responses will be in json format<br>
        standard succes response : &emsp;<i><?php echo htmlspecialchars( $result);?></i><br>
        actions :
        <ul>
            <li>
                <h2>user</h2>
                <ul>
                    <li>GET /user[?limit={limit}[&amp;offset={offset}]] : get all users</li>
                    <li>GET /user/{id} : get an user</li>
                    <li>GET /user/{id}/comments : get all comments made by the user</li>
                    <li>GET /user/{id}/posts : get all posts made by the user</li>
                    <li>POST /user : create an user</li>
                    <li>PATCH /user/{id} : update the adminLvL</li>
                </ul>
            </li>
            <li>
                <h2>category</h2>
                <li>GET /category : get all categories</li>
                <li>GET /category/{id} : get a category</li>
                <li>GET /category/{id}/posts : get all posts with this category</li>
                <li>POST /category : create a category</li>
                <li>PATCH /category/{id} : update the name</li>
            </li>
            <li>
                <h2>post</h2>
                <ul>
                    <li>GET /post[?limit={limit}[&amp;offset={offset}]] : get all posts</li>
                    <li>GET /post/{id} : get a post</li>
                    <li>GET /post/{id}/comments : get the comments on the post</li>
                    <li>POST /post : create a post</li>
                </ul>
            </li>
            <li>
                <h2>comment</h2>
                <ul>
                    <li>GET /comment[?limit={limit}[&amp;offset={offset}]] : get all comments</li>
                    <li>GET /comment/{id} : get a comment</li>
                    <li>POST /comment : create a comment</li>
                </ul>
            </li>
            <li>
                <h2>auth</h2>
                <ul>
                    <li>POST /auth/validate : validate a token</li>
                    <li>POST /auth/login : login a user and get a token</li>
                </ul>
            </li>
        </ul>
    </body>
</html>