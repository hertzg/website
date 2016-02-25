<?php

include_once '../../lib/defaults.php';

$base = '../';

include_once '../fns/simple_require_user.php';
$user = simple_require_user($base);

include_once '../fns/HomePage/create.php';
include_once '../lib/mysqli.php';
$content = HomePage\create($mysqli, $user, $head, $scripts);

include_once '../fns/echo_page.php';
echo_page($user, 'Home', $content, $base, [
    'head' => $head,
    'scripts' => $scripts,
]);
