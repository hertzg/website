<?php

namespace ApiCall\Error;

function badRequest ($error) {
    http_response_code(400);
    header('Content-Type: application/json');
    echo $error;
    exit;
}
