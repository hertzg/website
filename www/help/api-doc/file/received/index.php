<?php

include_once '../../../../../lib/defaults.php';

$subgroupKey = 'received';

include_once '../../fns/file/get_subgroups.php';
$subgroup = file\get_subgroups()[$subgroupKey];

include_once '../../fns/file/received/get_methods.php';
include_once '../../fns/subgroup_page.php';
subgroup_page('file', $subgroup, $subgroupKey, file\received\get_methods());
