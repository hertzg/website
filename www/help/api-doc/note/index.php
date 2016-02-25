<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/note/get_methods.php';
include_once '../fns/note/get_subgroups.php';
include_once '../fns/group_page.php';
group_page('note', note\get_methods(), note\get_subgroups());
