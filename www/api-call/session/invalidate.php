<?php

include_once '../../../lib/defaults.php';

include_once '../../fns/session_start_custom.php';
session_start_custom($new);

if ($new) {
    include_once '../../fns/ApiCall/Error/badRequest.php';
    ApiCall\Error\badRequest('"SESSION_INVALID"');
}

include_once '../../fns/Session/invalidate.php';
include_once '../../lib/mysqli.php';
Session\invalidate($mysqli);

header('Content-Type: application/json');
echo 'true';
