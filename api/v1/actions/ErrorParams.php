<?php
http_response_code( 400);
echo json_encode( array( "status" => "ERROR", "error" => "BAD REQUEST", "version" => "v1"));