<?php

include_once '../../../../../lib/defaults.php';

$subgroupKey = 'received';

include_once '../../fns/calculation/get_subgroups.php';
$subgroup = calculation\get_subgroups()[$subgroupKey];

include_once '../../fns/calculation/received/get_methods.php';
$methods = calculation\received\get_methods();

include_once '../../fns/subgroup_page.php';
subgroup_page('calculation', $subgroup, $subgroupKey, $methods);
