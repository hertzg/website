<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/schedule/get_methods.php';
include_once '../fns/schedule/get_subgroups.php';
include_once '../fns/group_page.php';
group_page('schedule', schedule\get_methods(), schedule\get_subgroups());
