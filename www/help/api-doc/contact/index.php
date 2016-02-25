<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/contact/get_methods.php';
include_once '../fns/contact/get_subgroups.php';
include_once '../fns/group_page.php';
group_page('contact', contact\get_methods(), contact\get_subgroups());
