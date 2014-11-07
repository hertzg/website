<?php

include_once '../fns/require_not_installed.php';
require_not_installed('../');

$_SESSION['install/agreement/accepted'] = true;

include_once '../../fns/redirect.php';
redirect('../requirements/');
