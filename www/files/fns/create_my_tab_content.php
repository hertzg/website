<?php

function create_my_tab_content ($user) {
    $storage_used = $user->storage_used;
    if ($storage_used) {
        include_once __DIR__.'/../../fns/bytestr.php';
        include_once __DIR__.'/../../fns/title_and_description.php';
        return title_and_description('My', bytestr($storage_used));
    }
    return 'My';
}
