<?php

function bad_request ($error) {
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode($error);
    exit;
}
