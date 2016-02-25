<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/channel/get_methods.php';
include_once '../fns/channel/get_subgroups.php';
include_once '../fns/group_page.php';
group_page('channel', channel\get_methods(), channel\get_subgroups());
