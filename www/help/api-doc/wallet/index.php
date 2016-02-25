<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/wallet/get_methods.php';
include_once '../fns/wallet/get_subgroups.php';
include_once '../fns/group_page.php';
group_page('wallet', wallet\get_methods(), wallet\get_subgroups());
