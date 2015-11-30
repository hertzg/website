<?php

include_once '../fns/calculation/get_methods.php';
include_once '../fns/calculation/get_subgroups.php';
include_once '../fns/group_page.php';
group_page('calculation', calculation\get_methods(), calculation\get_subgroups());
