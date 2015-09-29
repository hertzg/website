<?php

include_once '../../fns/session_start_custom.php';
session_start_custom($new);

session_destroy();

if ($new) {
    include_once '../../fns/ErrorJson/badRequest.php';
    ErrorJson\badRequest('"SESSION_INVALID"');
}

header('Content-Type: application/json');
echo 'true';
