<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/session_method_page.php';
session_method_page('extend', [], [
    'SESSION_INVALID' => 'The current session has already been invalidated.',
]);
