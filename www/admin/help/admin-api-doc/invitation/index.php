<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/invitation/get_methods.php';
include_once '../fns/group_page.php';
group_page('invitation', invitation\get_methods());
