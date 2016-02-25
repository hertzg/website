<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/file/get_methods.php';
include_once '../fns/file/get_subgroups.php';
include_once '../fns/group_page.php';
group_page('file', file\get_methods(), file\get_subgroups());
