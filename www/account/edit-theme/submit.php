<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');

include_once '../../fns/request_strings.php';
list($theme) = request_strings('theme');

include_once '../../fns/Themes/index.php';
$themes = Themes\index();

include_once '../../fns/redirect.php';

if (!array_key_exists($theme, $themes)) redirect();

include_once '../../fns/Users/editTheme.php';
include_once '../../lib/mysqli.php';
Users\editTheme($mysqli, $user->id_users, $theme);

$_SESSION['account/messages'] = ['Theme has changed.'];

redirect('..');
