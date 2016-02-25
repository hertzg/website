<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('place/delete', 'can_write_places', $apiKey, $user, $mysqli);

include_once 'fns/require_place.php';
$place = require_place($mysqli, $user);

include_once '../../fns/Users/Places/delete.php';
Users\Places\delete($mysqli, $place, $apiKey);

header('Content-Type: application/json');
echo 'true';
