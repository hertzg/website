<?php

function create_assert ($ok, $text) {
    return
        '<li'.($ok ? '' : ' class="error"').'>'
            .'<code>'.($ok ? '&#x2713;' : '&bull;').'</code>'
            ." $text"
        .'</li>';
}

include_once '../fns/require_not_installed.php';
require_not_installed();

unset($_SESSION['install/general-info/error']);

$apacheModules = apache_get_modules();

$ok = in_array('mod_rewrite', $apacheModules);
$text = 'Apache module "<code>mod_rewrite</code>" is enabled.';
$asserts = create_assert($ok, $text);

$ok = in_array('mod_headers', $apacheModules);
$text = 'Apache module "<code>mod_headers</code>" is enabled.';
$asserts .= create_assert($ok, $text);

$ok = date_default_timezone_get() === 'UTC';
$asserts .= create_assert($ok, 'PHP default timezone is set to UTC.');

$ok = function_exists('curl_init');
$asserts .= create_assert($ok, 'PHP Client URL Library is installed.');

$ok = function_exists('imagecreatefromstring');
$asserts .= create_assert($ok, 'PHP image processing and GD is installed.');

$ok = function_exists('mysqli_connect');
$asserts .= create_assert($ok, 'PHP MySQL improved extension is installed.');

$filename = 'fns/installed.php';
$ok = is_writable("../../$filename");
$text = "File \"<code>www/$filename</code>\" is writable.";
$asserts .= create_assert($ok, $text);

$filename = 'fns/get_mysqli_config.php';
$ok = is_writable("../../$filename");
$text = "File \"<code>www/$filename</code>\" is writable.";
$asserts .= create_assert($ok, $text);

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
        ."<ol>$asserts</ol>",
        '<span class="button disabled" />Back</span>'
        .'<a href="submit.php" class="button" />Next</a>'
    )
);
