<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/barChart/get_methods.php';
include_once '../fns/barChart/get_subgroups.php';
include_once '../fns/group_page.php';
group_page('barChart', barChart\get_methods(), barChart\get_subgroups());
