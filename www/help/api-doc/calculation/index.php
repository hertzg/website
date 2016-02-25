<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/calculation/get_subgroups.php';
$subgroups = calculation\get_subgroups();

include_once '../fns/calculation/get_methods.php';
include_once '../fns/group_page.php';
group_page('calculation', calculation\get_methods(), $subgroups);
