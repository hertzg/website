<?php

include_once '../fns/require_requirements.php';
require_requirements();

unset($_SESSION['install/general-info/error']);

include_once '../../fns/redirect.php';
redirect('../general-info/');
