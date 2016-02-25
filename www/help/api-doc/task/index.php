<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/task/get_methods.php';
include_once '../fns/task/get_subgroups.php';
include_once '../fns/group_page.php';
group_page('task', task\get_methods(), task\get_subgroups());
