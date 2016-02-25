<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('calculation/edit',
    'can_write_calculations', $apiKey, $user, $mysqli);

include_once 'fns/require_calculation.php';
$calculation = require_calculation($mysqli, $user);

include_once 'fns/require_calculation_params.php';
require_calculation_params($mysqli, $user, $expression,
    $title, $tags, $tag_names, $value, $error, $error_char,
    $resolved_expression, $depends, $calculation->id);

include_once '../../fns/Users/Calculations/edit.php';
Users\Calculations\edit($mysqli, $user, $calculation, $title,
    $expression, $tags, $tag_names, $value, $error, $error_char,
    $resolved_expression, $depends, $changed, $apiKey);

header('Content-Type: application/json');
echo 'true';
