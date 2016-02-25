<?php

include_once '../../../../../lib/defaults.php';

$subgroupKey = 'bar';

include_once '../../fns/barChart/get_subgroups.php';
$subgroup = barChart\get_subgroups()[$subgroupKey];

include_once '../../fns/barChart/bar/get_methods.php';
$methods = barChart\bar\get_methods();

include_once '../../fns/subgroup_page.php';
subgroup_page('barChart', $subgroup, $subgroupKey, $methods);
