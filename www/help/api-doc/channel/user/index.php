<?php

include_once '../../../../../lib/defaults.php';

$subgroupKey = 'user';

include_once '../../fns/channel/get_subgroups.php';
$subgroup = channel\get_subgroups()[$subgroupKey];

include_once '../../fns/channel/user/get_methods.php';
include_once '../../fns/subgroup_page.php';
subgroup_page('channel', $subgroup, $subgroupKey, channel\user\get_methods());
