<?php

include_once 'lib/require-user.php';
include_once 'fns/redirect.php';
include_once 'fns/request_strings.php';
include_once 'classes/Users.php';
include_once 'lib/themes.php';

list($theme) = request_strings('theme');

if (!isset($themes[$theme])) redirect();

Users::editTheme($idusers, $theme);

$_SESSION['account_messages'] = array('Theme has changed.');
redirect('account.php');
