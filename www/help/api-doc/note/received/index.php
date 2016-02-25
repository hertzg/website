<?php

include_once '../../../../../lib/defaults.php';

$subgroupKey = 'received';

include_once '../../fns/note/get_subgroups.php';
$subgroup = note\get_subgroups()[$subgroupKey];

include_once '../../fns/note/received/get_methods.php';
include_once '../../fns/subgroup_page.php';
subgroup_page('note', $subgroup, $subgroupKey, note\received\get_methods());
