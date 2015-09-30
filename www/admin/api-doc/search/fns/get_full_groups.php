<?php

function get_full_groups () {

    $dir = __DIR__.'/../../fns';

    include_once "$dir/get_groups.php";
    $groups = get_groups();

    include_once "$dir/invitation/get_methods.php";
    $groups['invitation']['methods'] = invitation\get_methods();

    include_once "$dir/user/get_methods.php";
    $groups['user']['methods'] = user\get_methods();

    return $groups;

}
