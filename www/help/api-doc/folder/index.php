<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/folder/get_methods.php';
include_once '../fns/folder/get_subgroups.php';
include_once '../fns/group_page.php';
group_page('folder', folder\get_methods(), folder\get_subgroups());
