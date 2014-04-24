<?php

function bad_request ($message) {
    http_response_code(400);
    header('Content-Type: application/json');
    die(json_encode(['message' => $message]));
}
