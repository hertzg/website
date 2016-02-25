<?php

include_once '../../../../../lib/defaults.php';

$subgroupKey = 'point';

include_once '../../fns/place/get_subgroups.php';
$subgroup = place\get_subgroups()[$subgroupKey];

include_once '../../fns/place/point/get_methods.php';
include_once '../../fns/subgroup_page.php';
subgroup_page('place', $subgroup, $subgroupKey, place\point\get_methods());
