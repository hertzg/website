<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user('../../');

include_once "$fnsDir/request_strings.php";
list($color) = request_strings('color');

include_once "$fnsDir/Theme/Color/index.php";
$colors = Theme\Color\index();

include_once "$fnsDir/redirect.php";

if (!array_key_exists($color, $colors)) redirect();

include_once "$fnsDir/Users/editThemeColor.php";
include_once '../../lib/mysqli.php';
Users\editThemeColor($mysqli, $user->id_users, $color);

$_SESSION['account/edit-theme/messages'] = ['Theme color has been changed.'];

redirect();
