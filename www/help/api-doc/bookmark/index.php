<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/bookmark/get_methods.php';
include_once '../fns/bookmark/get_subgroups.php';
include_once '../fns/group_page.php';
group_page('bookmark', bookmark\get_methods(), bookmark\get_subgroups());
