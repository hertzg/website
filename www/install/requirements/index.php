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

include_once '../fns/require_not_installed.php';
require_not_installed('../');

include_once '../fns/assert_failure.php';
include_once '../fns/assert_success.php';

$apacheModules = apache_get_modules();

$ok = in_array('mod_rewrite', $apacheModules);
$subject = 'Apache module "<code>mod_rewrite</code>"';
$assertsHtml = assert_enabled($ok, $subject);

$ok = in_array('mod_headers', $apacheModules);
$subject = 'Apache module "<code>mod_headers</code>"';
$assertsHtml .= assert_enabled($ok, $subject);

$ok = date_default_timezone_get() === 'UTC';
$subject = 'PHP default timezone';
if ($ok) $assertsHtml .= assert_success("$subject is set to UTC.");
else $assertsHtml .= assert_failure("$subject is NOT set to UTC.");

$ok = function_exists('curl_init');
$assertsHtml .= assert_installed($ok, 'PHP Client URL Library');

$ok = function_exists('imagecreatefromstring');
$assertsHtml .= assert_installed($ok, 'PHP image processing and GD');

$ok = function_exists('mysqli_connect');
$assertsHtml .= assert_installed($ok, 'PHP MySQL improved extension');

$assertsHtml .=
    assert_writable('admin/fns/get_admin.php')
    .assert_writable('fns/get_domain_name.php')
    .assert_writable('fns/get_mysqli_config.php')
    .assert_writable('fns/get_site_base.php')
    .assert_writable('fns/get_site_protocol.php')
    .assert_writable('fns/installed.php');

$nextSteps = ['General Information', 'MySQL Configuration',
    'Administrator', 'Finalize Installation'];

include_once '../fns/echo_page.php';
include_once '../fns/steps.php';
include_once '../fns/wizard_layout.php';
echo_page(
    'Step 1 - Requirements',
    wizard_layout(
        steps([], 'Requirements', $nextSteps),
        '<span class="title-step">Step 1</span>'
        .'<h2>Requirements</h2>'
        ."<ol>$assertsHtml</ol>",
        '<span class="button disabled" />Back</span>'
        .'<a href="submit.php" class="button nextButton" />Next</a>'
    )
);
