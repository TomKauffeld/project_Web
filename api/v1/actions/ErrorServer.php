<?php
header('Content-Type: application/json');
header( "Access-Control-Allow-Origin: *");
http_response_code( 500);
echo json_encode( array( "status" => "ERROR", "error" => "SERVER ERROR", "version" => "v1"));