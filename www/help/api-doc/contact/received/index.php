<?php

include_once '../../../../../lib/defaults.php';

$subgroupKey = 'received';

include_once '../../fns/contact/get_subgroups.php';
$subgroup = contact\get_subgroups()[$subgroupKey];

include_once '../../fns/contact/received/get_methods.php';
$methods = contact\received\get_methods();

include_once '../../fns/subgroup_page.php';
subgroup_page('contact', $subgroup, $subgroupKey, $methods);
