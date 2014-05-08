<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_api_key.php';
include_once '../../../lib/mysqli.php';
list($apiKey, $id, $user) = require_api_key($mysqli);

$_SESSION['account/api-keys/messages'] = ['The key has been deleted.'];
unset($_SESSION['account/api-keys/errors']);

include_once '../../../fns/Users/ApiKeys/delete.php';
Users\ApiKeys\delete($mysqli, $apiKey);

include_once '../../../fns/redirect.php';
redirect('..');
