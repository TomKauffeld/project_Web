<?php
http_response_code( 501);
echo json_encode( array( "status" => "ERROR", "error" => "BAD REQUEST", "version" => "v1"));