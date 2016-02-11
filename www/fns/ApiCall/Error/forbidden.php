<?php

namespace ApiCall\Error;

function forbidden ($error) {
    http_response_code(403);
    header('Content-Type: application/json');
    echo $error;
    exit;
}
