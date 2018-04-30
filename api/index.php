<html>
    <head>
        <title>Blog api</title>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <h1 id="top">The API for the blog website</h1>
        current version : v1<br>
        api link : <a href="https://pubflare.ovh/school/blog/api/latest/">https://pubflare.ovh/school/blog/api/latest</a> for the latest version<br>
        or instead of /api/latest you can select your version by going to /api/{api version} <br>
        to know which version you are using, check the "version" tag inside the responses<br>
        All responses will be in json format<br>
        standard succes response : &emsp;<i>{"status":"OK","version":"v1"}</i><br>
        <h2 onclick='$("#actions").toggle("slow");$(".function").hide("slow");$(".functions").hide("slow");$(".details:not(#actions)").hide("slow")'>actions</h2>
        <?php include __DIR__."/actions.html";?>
        <h2 onclick='$("#nodes").toggle("slow");$(".function").hide("slow");$(".functions").hide("slow");$(".details:not(#nodes)").hide("slow")'>nodes</h2>
        <div id=nodes class=details>
            <ul>
                <li>
                    <h2 onclick='$("#node_user").toggle("slow");$(".functions:not(#node_user)").hide("slow");'>user</h2>
                    <div id=node_user class=functions>
                        {<br>
                            &emsp;"id": [string, 100 characters long, unique],<br>
                            &emsp;"username": [string, between 3 and 100 characters long, unique],<br>
                            &emsp;"adminLvL": [integer : 0, 1, 2]<br>
                        }<br>
                    </div>
                </li>
                <li>
                    <h2 onclick='$("#node_category").toggle("slow");$(".functions:not(#node_category)").hide("slow");'>category</h2>
                    <div id=node_category class=functions>
                        {<br>
                            &emsp;"id": [string, 100 characters long, unique],<br>
                            &emsp;"name": [string, between 0 and 100 characters long, unique],<br>
                            &emsp;"description": [string, between 0 and 2000 characters long]<br>
                        }<br>
                    </div>
                </li>
                <li>
                    <h2 onclick='$("#node_post").toggle("slow");$(".functions:not(#node_post)").hide("slow");'>post</h2>
                    <div id=node_post class=functions>
                        {<br>
                            &emsp;"id": [string, 100 characters long,unique],<br>
                            &emsp;"author": [user.id],<br>
                            &emsp;"nbCategories": [int, equal or greater than 1],<br>
                            &emsp;"categories": [array of category.id],<br>
                            &emsp;"title": [string, between 3 and 100 characters long],<br>
                            &emsp;"body": [string, between 0 and 2000 characters long],<br>
                            &emsp;"time": [int, unix timestamp : number of seconds since 00:00:00, Thursday, 1 January 1970 (UTC)]<br>
                        }<br>
                    </div>
                </li>
                <li>
                    <h2 onclick='$("#node_comment").toggle("slow");$(".functions:not(#node_comment)").hide("slow");'>comment</h2>
                    <div id=node_comment class=functions>
                        {<br>
                            &emsp;"id": [string, 100 characters long, unique],<br>
                            &emsp;"post": [post.id],<br>
                            &emsp;"author": [user.id],<br>
                            &emsp;"body": [string, between 0 and 2000 characters long],<br>
                            &emsp;"time": [int, unix timestamp : number of seconds since 00:00:00, Thursday, 1 January 1970 (UTC)]<br>
                        }<br>
                    </div>
                </li>
            </ul>
        </div>
    </body>
    <footer>
        <script type="text/javascript">$(".function").hide();$(".functions").hide();$(".details").hide();</script>
    </footer>
</html>