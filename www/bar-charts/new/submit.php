<?php

include_once '../../../lib/defaults.php';

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once '../fns/request_bar_chart_params.php';
list($name, $tags, $tag_names) = request_bar_chart_params($errors, $focus);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['bar-charts/new/errors'] = $errors;
    $_SESSION['bar-charts/new/values'] = [
        'focus' => $focus,
        'name' => $name,
        'tags' => $tags,
    ];
    redirect();
}

unset(
    $_SESSION['bar-charts/new/errors'],
    $_SESSION['bar-charts/new/values']
);

include_once "$fnsDir/Users/BarCharts/add.php";
include_once '../../lib/mysqli.php';
$id = Users\BarCharts\add($mysqli, $user->id_users, $name, $tags, $tag_names);

$_SESSION['bar-charts/view/messages'] = ['Bar chart has been saved.'];

include_once "$fnsDir/ItemList/itemQuery.php";
redirect('../view/'.ItemList\itemQuery($id));
