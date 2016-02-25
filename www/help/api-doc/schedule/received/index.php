<?php

include_once '../../../../../lib/defaults.php';

$subgroupKey = 'received';

include_once '../../fns/schedule/get_subgroups.php';
$subgroup = schedule\get_subgroups()[$subgroupKey];

include_once '../../fns/schedule/received/get_methods.php';
$methods = schedule\received\get_methods();

include_once '../../fns/subgroup_page.php';
subgroup_page('schedule', $subgroup, $subgroupKey, $methods);
