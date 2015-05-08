<?php

function request_bar ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/BarChartBars/getNotDeletedOnUser.php";
    $bar = BarChartBars\getNotDeletedOnUser($mysqli, $user->id_users, $id);

    return [$bar, $id, $user];

}
