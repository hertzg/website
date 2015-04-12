<?php

include_once '../../fns/session_start_custom.php';
session_start_custom($new);

if ($new) {
    session_destroy();
    include_once '../fns/bad_request.php';
    bad_request('SESSION_INVALID');
}

header('Content-Type: application/json');
echo 'true';
