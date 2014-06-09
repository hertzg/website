<?php

$subgroupKey = 'subscribed';

include_once '../fns/get_subgroups.php';
$subgroup = get_subgroups()['subscribed'];

include_once 'fns/get_methods.php';
include_once '../../fns/subgroup_page.php';
subgroup_page('channel', $subgroup, $subgroupKey, get_methods());
