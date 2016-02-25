<?php

include_once '../../lib/defaults.php';

include_once 'fns/require_not_installed.php';
require_not_installed();

include_once '../fns/redirect.php';
redirect('agreement/');
