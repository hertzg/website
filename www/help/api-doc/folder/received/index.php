<?php

include_once '../../../../../lib/defaults.php';

$subgroupKey = 'received';

include_once '../../fns/folder/get_subgroups.php';
$subgroup = folder\get_subgroups()[$subgroupKey];

include_once '../../fns/folder/received/get_methods.php';
include_once '../../fns/subgroup_page.php';
subgroup_page('folder', $subgroup, $subgroupKey, folder\received\get_methods());
