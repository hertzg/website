<?php

function get_full_groups () {

    $dir = __DIR__.'/../../fns';

    include_once "$dir/get_groups.php";
    $groups = get_groups();

    include_once "$dir/bookmark/get_methods.php";
    $groups['bookmark']['methods'] = bookmark\get_methods();

    include_once "$dir/bookmark/get_subgroups.php";
    $groups['bookmark']['subgroups'] = bookmark\get_subgroups();

    include_once "$dir/bookmark/received/get_methods.php";
    $methods = bookmark\received\get_methods();
    $groups['bookmark']['subgroups']['received']['methods'] = $methods;

    include_once "$dir/channel/get_methods.php";
    $groups['channel']['methods'] = channel\get_methods();

    include_once "$dir/channel/get_subgroups.php";
    $groups['channel']['subgroups'] = channel\get_subgroups();

    include_once "$dir/channel/subscribed/get_methods.php";
    $methods = channel\subscribed\get_methods();
    $groups['channel']['subgroups']['subscribed']['methods'] = $methods;

    include_once "$dir/channel/user/get_methods.php";
    $methods = channel\user\get_methods();
    $groups['channel']['subgroups']['user']['methods'] = $methods;

    include_once "$dir/contact/get_methods.php";
    $groups['contact']['methods'] = contact\get_methods();

    include_once "$dir/contact/get_subgroups.php";
    $groups['contact']['subgroups'] = contact\get_subgroups();

    include_once "$dir/contact/photo/get_methods.php";
    $methods = contact\photo\get_methods();
    $groups['contact']['subgroups']['photo']['methods'] = $methods;

    include_once "$dir/contact/received/get_methods.php";
    $methods = contact\received\get_methods();
    $groups['contact']['subgroups']['received']['methods'] = $methods;

    include_once "$dir/event/get_methods.php";
    $groups['event']['methods'] = event\get_methods();

    include_once "$dir/file/get_methods.php";
    $groups['file']['methods'] = file\get_methods();

    include_once "$dir/file/get_subgroups.php";
    $groups['file']['subgroups'] = file\get_subgroups();

    include_once "$dir/file/received/get_methods.php";
    $methods = file\received\get_methods();
    $groups['file']['subgroups']['received']['methods'] = $methods;

    include_once "$dir/folder/get_methods.php";
    $groups['folder']['methods'] = folder\get_methods();

    include_once "$dir/note/get_methods.php";
    $groups['note']['methods'] = note\get_methods();

    include_once "$dir/note/get_subgroups.php";
    $groups['note']['subgroups'] = note\get_subgroups();

    include_once "$dir/note/received/get_methods.php";
    $methods = note\received\get_methods();
    $groups['note']['subgroups']['received']['methods'] = $methods;

    include_once "$dir/notification/get_methods.php";
    $groups['notification']['methods'] = notification\get_methods();

    include_once "$dir/schedule/get_methods.php";
    $groups['schedule']['methods'] = schedule\get_methods();

    include_once "$dir/task/get_methods.php";
    $groups['task']['methods'] = task\get_methods();

    include_once "$dir/task/get_subgroups.php";
    $groups['task']['subgroups'] = task\get_subgroups();

    include_once "$dir/task/received/get_methods.php";
    $methods = task\received\get_methods();
    $groups['task']['subgroups']['received']['methods'] = $methods;

    return $groups;

}
