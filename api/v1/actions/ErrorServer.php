<?php
header('Content-Type: application/json');
http_response_code( 500);
echo json_encode( array( "status" => "ERROR", "error" => "SERVER ERROR", "version" => "v1"));