<?php

function get_full_groups () {

    include_once __DIR__.'/../../fns/get_groups.php';
    $groups = get_groups();

    include_once __DIR__.'/../../fns/bookmark/get_subgroups.php';
    $groups['bookmark']['subgroups'] = bookmark\get_subgroups();

    include_once __DIR__.'/../../fns/channel/get_subgroups.php';
    $groups['channel']['subgroups'] = channel\get_subgroups();

    include_once __DIR__.'/../../fns/contact/get_subgroups.php';
    $groups['contact']['subgroups'] = contact\get_subgroups();

    $groups['event']['subgroups'] = [];

    include_once __DIR__.'/../../fns/file/get_subgroups.php';
    $groups['file']['subgroups'] = file\get_subgroups();

    $groups['folder']['subgroups'] = [];

    include_once __DIR__.'/../../fns/note/get_subgroups.php';
    $groups['note']['subgroups'] = note\get_subgroups();

    $groups['notification']['subgroups'] = [];

    include_once __DIR__.'/../../fns/task/get_subgroups.php';
    $groups['task']['subgroups'] = task\get_subgroups();

    return $groups;

}
