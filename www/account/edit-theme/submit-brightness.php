<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user('../../');

include_once "$fnsDir/request_strings.php";
list($brightness) = request_strings('brightness');

include_once "$fnsDir/Theme/Brightness/index.php";
$brightnesses = Theme\Brightness\index();

include_once "$fnsDir/redirect.php";

if (!array_key_exists($brightness, $brightnesses)) redirect();

include_once "$fnsDir/Users/editThemeBrightness.php";
include_once '../../lib/mysqli.php';
Users\editThemeBrightness($mysqli, $user->id_users, $brightness);

$message = 'Theme brightness has been changed.';
$_SESSION['account/edit-theme/messages'] = [$message];

redirect();
