<?php

include_once '../../../../../lib/defaults.php';

$subgroupKey = 'subscribed';

include_once '../../fns/channel/get_subgroups.php';
$subgroup = channel\get_subgroups()[$subgroupKey];

include_once '../../fns/channel/subscribed/get_methods.php';
$methods = channel\subscribed\get_methods();

include_once '../../fns/subgroup_page.php';
subgroup_page('channel', $subgroup, $subgroupKey, $methods);
