<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/place/get_methods.php';
include_once '../fns/place/get_subgroups.php';
include_once '../fns/group_page.php';
group_page('place', place\get_methods(), place\get_subgroups());
