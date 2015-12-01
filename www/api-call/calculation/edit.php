<?php

include_once '../fns/require_api_key.php';
require_api_key('can_write_calculations', $apiKey, $user, $mysqli);

include_once 'fns/require_calculation.php';
$calculation = require_calculation($mysqli, $user);

include_once 'fns/require_calculation_params.php';
require_calculation_params($expression, $title, $tags, $tag_names);

include_once '../../fns/Users/Calculations/edit.php';
Users\Calculations\edit($mysqli, $calculation, $title,
    $expression, $tags, $tag_names, $changed, $apiKey);

header('Content-Type: application/json');
echo 'true';
