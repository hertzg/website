<?php

include_once '../fns/require_admin.php';
require_admin();

include_once 'fns/assert.php';

$apacheModules = apache_get_modules();

$ok = in_array('mod_rewrite', $apacheModules);
$content = assert_enabled($ok, 'Apache module "mod_rewrite"');

$ok = in_array('mod_headers', $apacheModules);
$content .= assert_enabled($ok, 'Apache module "mod_headers"');

$ok = date_default_timezone_get() === 'UTC';
$subject = 'PHP default timezone';
if ($ok) $content .= assert_success("$subject is set to UTC.");
else $content .= assert_failure("$subject is NOT set to UTC.");

$ok = function_exists('curl_init');
$content .= assert_installed($ok, 'PHP Client URL Library "curl"');

$ok = function_exists('gmp_init');
$content .= assert_installed($ok, 'GNU Multiple Precision "gmp"');

$ok = function_exists('imagecreatefromstring');
$content .= assert_installed($ok, 'PHP image processing and GD "gd"');

$mysqliOk = function_exists('mysqli_connect');
$text = 'PHP MySQL improved extension "mysqli"';
$content .= assert_installed($mysqliOk, $text);

include_once '../../fns/ContactPhotos/dir.php';
include_once '../../fns/Users/Directory/dir.php';
$content .=
    assert_writable_file('../../fns/Admin/get.php')
    .assert_writable_file('../../fns/DomainName/get.php')
    .assert_writable_file('../../fns/InfoEmail/get.php')
    .assert_writable_file('../../fns/Installed/get.php')
    .assert_writable_file('../../fns/MysqlConfig/get.php')
    .assert_writable_file('../../fns/SiteBase/get.php')
    .assert_writable_file('../../fns/SiteProtocol/get.php')
    .assert_writable_folder(ContactPhotos\dir())
    .assert_writable_folder(Users\Directory\dir());

if ($mysqliOk) {
    include_once 'fns/check_user_data.php';
    include_once '../../lib/mysqli.php';
    $content .= check_user_data($mysqli);
} else {
    $content .= assert_failure(
        'MySQL improved extension is required to continue.'
        .' Further checks have been aborted.');
}

include_once '../../fns/Page/phpCode.php';
include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Administration',
            'href' => '../#check-installation',
        ],
    ],
    'Check Installation',
    Page\phpCode($content)
);

include_once '../../fns/echo_guest_page.php';
echo_guest_page('Check Installation', $content, '../../', [
    'head' => '<link rel="stylesheet" type="text/css" href="index.css" />',
]);
