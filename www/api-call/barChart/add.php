<?php

include_once '../fns/require_api_key.php';
require_api_key('can_write_bar_charts', $apiKey, $user, $mysqli);

include_once 'fns/request_bar_chart_params.php';
list($name, $tags, $tag_names) = request_bar_chart_params();

include_once '../../fns/Users/BarCharts/add.php';
$id = Users\BarCharts\add($mysqli,
    $user->id_users, $name, $tags, $tag_names, $apiKey);

header('Content-Type: application/json');
echo $id;
