<?php

$subgroupKey = 'received';

include_once '../fns/get_subgroups.php';
$subgroup = get_subgroups()['received'];

include_once 'fns/get_methods.php';
include_once '../../fns/subgroup_page.php';
subgroup_page('contact', $subgroup, $subgroupKey, get_methods());
