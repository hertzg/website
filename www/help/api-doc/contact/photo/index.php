<?php

include_once '../../../../../lib/defaults.php';

$subgroupKey = 'photo';

include_once '../../fns/contact/get_subgroups.php';
$subgroup = contact\get_subgroups()[$subgroupKey];

include_once '../../fns/contact/photo/get_methods.php';
$methods = contact\photo\get_methods();

include_once '../../fns/subgroup_page.php';
subgroup_page('contact', $subgroup, $subgroupKey, $methods);
