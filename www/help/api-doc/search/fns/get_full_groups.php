<?php

function get_full_groups () {

    include_once __DIR__.'/../../fns/get_groups.php';
    $groups = get_groups();

    include_once __DIR__.'/../../fns/bookmark/get_subgroups.php';
    $groups['bookmark']['subgroups'] = bookmark\get_subgroups();

    include_once __DIR__.'/../../fns/bookmark/get_methods.php';
    $groups['bookmark']['methods'] = bookmark\get_methods();

    include_once __DIR__.'/../../fns/channel/get_subgroups.php';
    $groups['channel']['subgroups'] = channel\get_subgroups();

    include_once __DIR__.'/../../fns/channel/get_methods.php';
    $groups['channel']['methods'] = channel\get_methods();

    include_once __DIR__.'/../../fns/contact/get_subgroups.php';
    $groups['contact']['subgroups'] = contact\get_subgroups();

    include_once __DIR__.'/../../fns/contact/get_methods.php';
    $groups['contact']['methods'] = contact\get_methods();

    $groups['event']['subgroups'] = [];

    include_once __DIR__.'/../../fns/event/get_methods.php';
    $groups['event']['methods'] = event\get_methods();

    include_once __DIR__.'/../../fns/file/get_subgroups.php';
    $groups['file']['subgroups'] = file\get_subgroups();

    include_once __DIR__.'/../../fns/file/get_methods.php';
    $groups['file']['methods'] = file\get_methods();

    $groups['folder']['subgroups'] = [];

    include_once __DIR__.'/../../fns/folder/get_methods.php';
    $groups['folder']['methods'] = folder\get_methods();

    include_once __DIR__.'/../../fns/note/get_subgroups.php';
    $groups['note']['subgroups'] = note\get_subgroups();

    include_once __DIR__.'/../../fns/note/get_methods.php';
    $groups['note']['methods'] = note\get_methods();

    $groups['notification']['subgroups'] = [];

    include_once __DIR__.'/../../fns/notification/get_methods.php';
    $groups['notification']['methods'] = notification\get_methods();

    include_once __DIR__.'/../../fns/task/get_subgroups.php';
    $groups['task']['subgroups'] = task\get_subgroups();

    include_once __DIR__.'/../../fns/task/get_methods.php';
    $groups['task']['methods'] = task\get_methods();

    return $groups;

}
