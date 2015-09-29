<?php

namespace ErrorJson;

function forbidden ($error) {
    http_response_code(403);
    header('Content-Type: application/json');
    echo $error;
    exit;
}
