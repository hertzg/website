<?php

include_once '../../../../../lib/defaults.php';

$subgroupKey = 'received';

include_once '../../fns/bookmark/get_subgroups.php';
$subgroup = bookmark\get_subgroups()[$subgroupKey];

include_once '../../fns/bookmark/received/get_methods.php';
$methods = bookmark\received\get_methods();

include_once '../../fns/subgroup_page.php';
subgroup_page('bookmark', $subgroup, $subgroupKey, $methods);
