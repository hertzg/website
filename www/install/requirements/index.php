<?php

function assert_enabled ($ok, $subject) {
    if ($ok) return assert_success("$subject is enabled.");
    return assert_failure("$subject is NOT enabled.");
}

function assert_installed ($ok, $subject) {
    if ($ok) return assert_success("$subject is installed.");
    return assert_failure("$subject is NOT installed.");
}

function assert_writable ($filename) {
    $ok = is_writable("../../$filename");
    $subject = "File \"<code>www/$filename</code>\"";
    if ($ok) return assert_success("$subject is writable.");
    return assert_failure("$subject is NOT writable.");
}

include_once '../fns/require_agreement.php';
require_agreement();

include_once '../fns/assert_failure.php';
include_once '../fns/assert_success.php';

$apacheModules = apache_get_modules();

$ok = in_array('mod_rewrite', $apacheModules);
$subject = 'Apache module "<code>mod_rewrite</code>"';
$assertsHtml = assert_enabled($ok, $subject);

$ok = array_key_exists('HTACCESS_WORKING', $_SERVER);
$assertsHtml .= assert_enabled($ok, '"<code>.htaccess</code>"');

$ok = date_default_timezone_get() === 'UTC';
$subject = 'PHP default timezone';
if ($ok) $assertsHtml .= assert_success("$subject is set to UTC.");
else $assertsHtml .= assert_failure("$subject is NOT set to UTC.");

$subject = 'PHP Client URL Library "<code>curl</code>"';
$assertsHtml .= assert_installed(extension_loaded('curl'), $subject);

$subject = 'PHP image processing and GD "<code>gd</code>"';
$assertsHtml .= assert_installed(extension_loaded('gd'), $subject);

$subject = 'PHP MySQL improved extension "<code>mysqli</code>"';
$assertsHtml .= assert_installed(function_exists('mysql'), $subject);

$assertsHtml .=
    assert_writable('data/contact-photos')
    .assert_writable('data/users')
    .assert_writable('.htaccess')
    .assert_writable('fns/Admin/get.php')
    .assert_writable('fns/AdminApiKeys/OrderBy/get.php')
    .assert_writable('fns/ClientAddress/get.php')
    .assert_writable('fns/ClientAddress/GetMethod/get.php')
    .assert_writable('fns/DomainName/get.php')
    .assert_writable('fns/InfoEmail/get.php')
    .assert_writable('fns/Installed/get.php')
    .assert_writable('fns/MysqlConfig/get.php')
    .assert_writable('fns/SignUpEnabled/get.php')
    .assert_writable('fns/SiteBase/get.php')
    .assert_writable('fns/SiteProtocol/get.php')
    .assert_writable('fns/SiteTitle/get.php')
    .assert_writable('fns/Users/OrderBy/get.php');

$ok = in_array('mod_headers', $apacheModules);
$subject = 'Apache module "<code>mod_headers</code>"';
$optionalAssertsHtml = assert_enabled($ok, $subject);

$subject = 'Image Processing (ImageMagick) "<code>imagick</code>"';
$optionalAssertsHtml .= assert_installed(extension_loaded('imagick'), $subject);

include_once 'fns/create_steps.php';
include_once '../fns/echo_page.php';
include_once '../fns/wizard_layout.php';
echo_page(
    'Step 2 - Requirements',
    wizard_layout(
        create_steps(),
        '<span class="title-step">Step 2</span>'
        .'<h2>Requirements</h2>'
        ."<ol>$assertsHtml</ol>"
        .'<h3>Optionally</h3>'
        ."<ol>$optionalAssertsHtml</ol>",
        '<a href="submit.php" class="button nextButton" tabindex="1">Next</a>'
        .'<a class="button" href="../agreement/">Back</a>'
    )
);
