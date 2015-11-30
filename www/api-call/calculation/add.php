<?php

include_once '../fns/require_api_key.php';
require_api_key('can_write_calculations', $apiKey, $user, $mysqli);

include_once 'fns/require_calculation_params.php';
require_calculation_params($url, $title, $tags, $tag_names);

include_once '../../fns/Users/Calculations/add.php';
$id = Users\Calculations\add($mysqli, $user->id_users,
    $url, $title, $tags, $tag_names, $apiKey);

header('Content-Type: application/json');
echo $id;
