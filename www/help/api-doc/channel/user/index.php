<?php

$subgroupKey = 'user';

include_once '../fns/get_subgroups.php';
$subgroup = get_subgroups()['user'];

include_once 'fns/get_methods.php';
include_once '../../fns/subgroup_page.php';
subgroup_page('note', $subgroup, $subgroupKey, get_methods());
