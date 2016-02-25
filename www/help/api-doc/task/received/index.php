<?php

include_once '../../../../../lib/defaults.php';

$subgroupKey = 'received';

include_once '../../fns/task/get_subgroups.php';
$subgroup = task\get_subgroups()[$subgroupKey];

include_once '../../fns/task/received/get_methods.php';
include_once '../../fns/subgroup_page.php';
subgroup_page('task', $subgroup, $subgroupKey, task\received\get_methods());
