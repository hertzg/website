<?php

include_once 'lib/sameDomainReferer.php';
include_once 'fns/redirect.php';
if (!$sameDomainReferer) redirect();
include_once 'lib/require-user.php';
include_once 'fns/request_strings.php';
include_once 'classes/Users.php';
include_once 'lib/themes.php';

list($theme) = request_strings('theme');

if (!array_key_exists($theme, $themes)) redirect();

Users::editTheme($idusers, $theme);

$_SESSION['account_messages'] = array('Theme has changed.');
redirect('account/');
