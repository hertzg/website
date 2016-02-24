<?php

include_once '../fns/require_api_key.php';
require_api_key('place/deleteAll', 'can_write_places', $apiKey, $user, $mysqli);

include_once '../../fns/Users/Places/deleteAll.php';
Users\Places\deleteAll($mysqli, $user, $apiKey);

header('Content-Type: application/json');
echo 'true';
