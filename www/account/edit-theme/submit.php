<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user('../../');

include_once "$fnsDir/request_strings.php";
list($theme) = request_strings('theme');

include_once "$fnsDir/Themes/index.php";
$themes = Themes\index();

include_once "$fnsDir/redirect.php";

if (!array_key_exists($theme, $themes)) redirect();

include_once "$fnsDir/Users/editTheme.php";
include_once '../../lib/mysqli.php';
Users\editTheme($mysqli, $user->id_users, $theme);

$_SESSION['account/edit-theme/messages'] = ['Theme color has been changed.'];

redirect();
