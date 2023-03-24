<?php


function response_helper($titleBody = 'data', $content = '', $status = 200){

    $json = json_encode([$titleBody => $content], JSON_PRETTY_PRINT);
    header('Content-Type: application/json');
    set_status_header($status);
    echo $json;
}