<?php

function returnJsonHttpResponse($data = null, $httpStatus = 200 ){
    // remove any string that could create an invalid JSON 
    // such as PHP Notice, Warning, logs...
    ob_clean();

    // this will clean up any previously added headers, to start clean
    header_remove();

    // Set the content type to JSON and charset 
    // (charset can be set to something else)
    header("Content-type: application/json; charset=utf-8");
    
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

    // Set your HTTP response code, 2xx = SUCCESS, 
    // anything else will be error, refer to HTTP documentation
    if ( $httpStatus ) {
        http_response_code($httpStatus);
    } else {
        http_response_code(500);
    }

    // encode your PHP Object or Array into a JSON string.
    // stdClass or array
    return json_encode($data);

    // making sure nothing is added
    exit();
}

?>
