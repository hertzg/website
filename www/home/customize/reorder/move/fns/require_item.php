<?php

function require_item () {

    $fnsDir = __DIR__.'/../../../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../../../');

    include_once "$fnsDir/request_strings.php";
    list($key) = request_strings('key');

    include_once __DIR__.'/../../fns/get_home_items.php';
    $homeItems = get_home_items();

    if (!array_key_exists($key, $homeItems)) {
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    if (!$user->admin && $key === 'admin') {
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    $item = [
        'title' => $homeItems[$key][0],
    ];

    return [$item, $key, $user];

}
