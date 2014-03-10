<?php

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_user.php';
$user = require_user('../');
$idusers = $user->idusers;

include_once '../fns/request_strings.php';
list($theme) = request_strings('theme');

include_once '../fns/get_themes.php';
$themes = get_themes();

if (!array_key_exists($theme, $themes)) redirect();

include_once '../fns/Users/editTheme.php';
include_once '../lib/mysqli.php';
Users\editTheme($mysqli, $idusers, $theme);

$_SESSION['account/index_messages'] = array('Theme has changed.');

include_once '../fns/redirect.php';
redirect('../account/');
