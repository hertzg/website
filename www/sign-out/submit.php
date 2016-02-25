<?php

include_once '../../lib/defaults.php';

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/request_strings.php';
list($auto) = request_strings('auto');

include_once '../fns/session_start_custom.php';
session_start_custom($new);

include_once '../fns/Session/invalidate.php';
include_once '../lib/mysqli.php';
Session\invalidate($mysqli);

if ($auto) $message = 'You have automatically been signed out.';
else $message = 'You have been signed out.';

$_SESSION['sign-in/messages'] = [$message];
unset($_SESSION['sign-in/errors']);

include_once '../fns/redirect.php';
redirect('../sign-in/');
