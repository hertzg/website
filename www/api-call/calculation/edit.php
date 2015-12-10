<?php

include_once '../fns/require_api_key.php';
require_api_key('can_write_calculations', $apiKey, $user, $mysqli);

include_once 'fns/require_calculation.php';
$calculation = require_calculation($mysqli, $user);

include_once 'fns/require_user_calculation_params.php';
require_user_calculation_params($mysqli, $user,
    $expression, $title, $tags, $tag_names, $value, $error,
    $error_char, $referenced, $calculation->id);

include_once '../../fns/Users/Calculations/edit.php';
Users\Calculations\edit($mysqli, $calculation,
    $title, $expression, $tags, $tag_names, $value, $error,
    $error_char, $referenced, $changed, $apiKey);

header('Content-Type: application/json');
echo 'true';
