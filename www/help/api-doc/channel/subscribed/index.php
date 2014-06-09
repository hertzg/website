<?php

$subgroupKey = 'subscribed';

include_once '../../fns/channel/get_subgroups.php';
$subgroup = channel\get_subgroups()['subscribed'];

include_once '../../fns/channel/get_methods.php';
include_once '../../fns/subgroup_page.php';
subgroup_page('channel', $subgroup, $subgroupKey, channel\get_methods());
