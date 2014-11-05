<?php

function create_assert ($ok, $text) {
    return
        '<li'.($ok ? '' : ' class="error"').'>'
            .'<code>'.($ok ? '&#x2713;' : '&bull;').'</code>'
            ." $text"
        .'</li>';
}

include_once '../../fns/session_start_custom.php';
session_start_custom();

unset($_SESSION['install/mysql-config/error']);

$apacheModules = apache_get_modules();

$ok = in_array('mod_rewrite', $apacheModules);
$asserts = create_assert($ok, 'Apache <code>mod_rewrite</code> enabled.');

$ok = in_array('mod_headers', $apacheModules);
$asserts .= create_assert($ok, 'Apache <code>mod_headers</code> enabled.');

$ok = date_default_timezone_get() === 'UTC';
$asserts .= create_assert($ok, 'PHP default timezone set to UTC.');

$ok = function_exists('curl_init');
$asserts .= create_assert($ok, 'PHP Client URL Library installed.');

$ok = function_exists('imagecreatefromstring');
$asserts .= create_assert($ok, 'PHP image processing and GD installed.');

$ok = function_exists('mysqli_connect');
$asserts .= create_assert($ok, 'PHP MySQL improved extension installed.');

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
                .'<code>&bull;</code> MySQL Configuration'
            .'</li>'
            .'<li class="steps-next">'
                .'<code>&bull;</code> Finalize Installation'
            .'</li>'
        .'</ul>',
        '<h2>Requirements</h2>'
        ."<ol>$asserts</ol>",
        '<span class="button disabled" />Back</span>'
        .'<a href="../mysql-config/" class="button" />Next</a>'
    )
);
