<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');

include_once '../fns/require_user.php';
require_user('../');

include_once '../fns/request_strings.php';
list($theme) = request_strings('theme');

include_once '../lib/themes.php';
if (!array_key_exists($theme, $themes)) redirect();

include_once '../fns/Users/editTheme.php';
include_once '../lib/mysqli.php';
Users\editTheme($mysqli, $idusers, $theme);

$_SESSION['account/index_messages'] = array('Theme has changed.');

redirect('../account/');
