<?php

include_once '../../../../../lib/defaults.php';

$subgroupKey = 'received';

include_once '../../fns/place/get_subgroups.php';
$subgroup = place\get_subgroups()[$subgroupKey];

include_once '../../fns/place/received/get_methods.php';
include_once '../../fns/subgroup_page.php';
subgroup_page('place', $subgroup, $subgroupKey, place\received\get_methods());
