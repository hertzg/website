<?php

function require_item () {

    include_once __DIR__.'/../../../../fns/require_user.php';
    $user = require_user('../../../');

    include_once __DIR__.'/../../../../fns/request_strings.php';
    list($key) = request_strings('key');

    include_once __DIR__.'/../../fns/get_home_items.php';
    $homeItems = get_home_items();

    if (!array_key_exists($key, $homeItems)) {
        include_once __DIR__.'/../../../../fns/redirect.php';
        redirect('../../');
    }

    $item = array(
        'title' => $homeItems[$key][0],
    );

    return array($item, $key, $user);

}
