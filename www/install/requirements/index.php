<?php

function create_assert ($ok, $text) {
    return
        '<li'.($ok ? '' : ' class="error"').'>'
            .'<code>'.($ok ? '&#x2713;' : '&bull;').'</code>'
            ." $text"
        .'</li>';
}

function writable_file ($filename) {
    $ok = is_writable("../../$filename");
    $text = "File \"<code>www/$filename</code>\" is writable.";
    return create_assert($ok, $text);
}

include_once '../fns/require_not_installed.php';
require_not_installed();

$apacheModules = apache_get_modules();

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
    .writable_file('fns/installed.php');

include_once '../fns/echo_page.php';
include_once '../fns/wizard_layout.php';
echo_page(
    'Requirements',
    wizard_layout(
        '<ul class="steps">'
            .'<li class="steps-active">'
                .'<code>&bull;</code> Requirements'
            .'</li>'
            .'<li class="steps-next">'
                .'<code>&bull;</code> General Information'
            .'</li>'
            .'<li class="steps-next">'
                .'<code>&bull;</code> MySQL Configuration'
            .'</li>'
            .'<li class="steps-next">'
                .'<code>&bull;</code> Finalize Installation'
            .'</li>'
        .'</ul>',
        '<h2>Requirements</h2>'
        ."<ol>$assertsHtml</ol>",
        '<span class="button disabled" />Back</span>'
        .'<a href="submit.php" class="button" />Next</a>'
    )
);
