<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_admin.php';
$admin_user = require_admin();

include_once 'fns/assert.php';

$apacheModules = apache_get_modules();

$ok = in_array('mod_rewrite', $apacheModules);
$content = assert_enabled($ok, 'Apache module "mod_rewrite"');

$ok = array_key_exists('HTACCESS_WORKING', $_SERVER);
$content .= assert_enabled($ok, '".htaccess"');

$ok = extension_loaded('curl');
$content .= assert_installed($ok, 'PHP Client URL Library "curl"');

$ok = extension_loaded('gd');
$content .= assert_installed($ok, 'PHP image processing and GD "gd"');

$mysqliOk = extension_loaded('mysql');
$text = 'PHP MySQL improved extension "mysqli"';
$content .= assert_installed($mysqliOk, $text);

include_once '../../fns/ContactPhotos/dir.php';
include_once '../../fns/Users/Directory/dir.php';
$content .=
    assert_writable_file('../../.htaccess')
    .assert_writable_file('../../fns/Admin/get.php')
    .assert_writable_file('../../fns/AdminApiKeys/OrderBy/get.php')
    .assert_writable_file('../../fns/AutoUpdateEnabled/get.php')
    .assert_writable_file('../../fns/DomainName/get.php')
    .assert_writable_file('../../fns/InfoEmail/get.php')
    .assert_writable_file('../../fns/Installed/get.php')
    .assert_writable_file('../../fns/MysqlConfig/get.php')
    .assert_writable_file('../../fns/NumReverseProxies/get.php')
    .assert_writable_file('../../fns/SignUpEnabled/get.php')
    .assert_writable_file('../../fns/SiteBase/get.php')
    .assert_writable_file('../../fns/SiteProtocol/get.php')
    .assert_writable_file('../../fns/SiteTitle/get.php')
    .assert_writable_file('../../fns/Users/OrderBy/get.php')
    .assert_writable_folder(ContactPhotos\dir())
    .assert_writable_folder(Users\Directory\dir());

$ok = in_array('mod_headers', $apacheModules);
$content .= assert_enabled($ok, 'Optionally Apache module "mod_headers"');

$subject = 'Optionally Image Processing (ImageMagick) "imagick"';
$content .= assert_installed(extension_loaded('imagick'), $subject);

if ($mysqliOk) {

    include_once '../../fns/get_mysqli.php';
    $mysqli = get_mysqli();

    if ($mysqli->connect_errno) {
        $content .= assert_failure(
            'Failed to connect to MySQL server. Cannot continue.');
    } else {
        include_once 'fns/check_user_data.php';
        $content .= check_user_data($mysqli);
    }

} else {
    $content .= assert_failure(
        'MySQL improved extension is required to continue.'
        .' Further checks have been aborted.');
}

include_once '../../fns/Page/create.php';
include_once '../../fns/Page/sourceCode.php';
$content = Page\create(
    [
        'title' => 'Administration',
        'href' => '../#check-installation',
    ],
    'Check Installation',
    Page\sourceCode($content)
);

include_once '../fns/echo_admin_page.php';
echo_admin_page($admin_user, 'Check Installation', $content, '../', [
    'head' => '<style type="text/css">.not_ok { font-weight: bold }</style>',
]);
