<?php

function bad_request ($message) {
    http_response_code(400);
    die(json_encode(['message' => $message]));
}
