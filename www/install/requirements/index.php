<?php

function writable_file ($filename) {
    $ok = is_writable("../../$filename");
    $text = "File \"<code>www/$filename</code>\" is writable.";
    return create_assert($ok, $text);
}

include_once '../fns/require_not_installed.php';
require_not_installed('../');

$apacheModules = apache_get_modules();

include_once '../fns/create_assert.php';
$ok = in_array('mod_rewrite', $apacheModules);
$text = 'Apache module "<code>mod_rewrite</code>" is enabled.';
$assertsHtml = create_assert($ok, $text);

$ok = in_array('mod_headers', $apacheModules);
$text = 'Apache module "<code>mod_headers</code>" is enabled.';
$assertsHtml .= create_assert($ok, $text);

$ok = date_default_timezone_get() === 'UTC';
$assertsHtml .= create_assert($ok, 'PHP default timezone is set to UTC.');

$ok = function_exists('curl_init');
$assertsHtml .= create_assert($ok, 'PHP Client URL Library is installed.');

$ok = function_exists('imagecreatefromstring');
$text = 'PHP image processing and GD is installed.';
$assertsHtml .= create_assert($ok, $text);

$ok = function_exists('mysqli_connect');
$text = 'PHP MySQL improved extension is installed.';
$assertsHtml .= create_assert($ok, $text);

$assertsHtml .=
    writable_file('admin/fns/get_admin.php')
    .writable_file('fns/get_domain_name.php')
    .writable_file('fns/get_mysqli_config.php')
    .writable_file('fns/get_site_base.php')
    .writable_file('fns/get_site_protocol.php')
    .writable_file('fns/installed.php');

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
