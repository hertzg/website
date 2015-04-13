<?php

include_once '../fns/require_general_info.php';
require_general_info();

$key = 'install/mysql-config/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $username = exec('whoami', $username);
    $values = [
        'host' => 'localhost',
        'username' => $username,
        'password' => '',
        'db' => 'zvini',
        'create' => true,
    ];

}

$key = 'install/mysql-config/error';
if (array_key_exists($key, $_SESSION)) {
    $errorHtml =
        '<div class="error formError">'
            ."&times; {$_SESSION[$key]}"
        .'</div>';
} else {
    $errorHtml = '';
}

$doneSteps = [
    [
        'title' => 'Agreement',
        'href' => '../agreement/',
    ],
    [
        'title' => 'Requirements',
        'href' => '../requirements/',
    ],
    [
        'title' => 'General Information',
        'href' => '../general-info/',
    ],
];
$nextSteps = ['Administrator', 'Finalize Installation'];

include_once '../fns/echo_page.php';
include_once '../fns/field_columns.php';
include_once '../fns/steps.php';
include_once '../fns/wizard_layout.php';
echo_page(
    'Step 4 - MySQL Configuration',
    '<form action="submit.php" method="post">'
        .wizard_layout(
            steps($doneSteps, 'MySQL Configuration', $nextSteps),
            '<span class="title-step">Step 4</span>'
            .'<h2>MySQL Configuration</h2>'
            .field_columns(
                '<label for="hostInput">Host:</label>'
                .'<br />'
                .'<input class="textfield" type="text" required="required"'
                .' name="host" id="hostInput" autofocus="autofocus"'
                .' value="'.htmlspecialchars($values['host']).'" />',
                '<label for="dbInput">Database:</label>'
                .'<br />'
                .'<input class="textfield" type="text"'
                .' name="db" id="dbInput" required="required"'
                .' value="'.htmlspecialchars($values['db']).'" />'
            )
            .field_columns(
                '<label for="usernameInput">Username:</label>'
                .'<br />'
                .'<input class="textfield" type="text"'
                .' name="username" id="usernameInput" required="required"'
                .' value="'.htmlspecialchars($values['username']).'" />',
                '<label for="passwordInput">Password:</label>'
                .'<br />'
                .'<input class="textfield" type="password"'
                .' name="password" id="passwordInput"'
                .' value="'.htmlspecialchars($values['password']).'" />'
            )
            .'<div>'
                .'<input type="checkbox" name="create" id="createInput"'
                .($values['create'] ? ' checked="checked"' : '').' />'
                .' <label for="createInput">'
                    .'Create database if it doesn\'t exist.'
                .'</label>'
            .'</div>'
            .$errorHtml,
            '<input type="submit" class="button nextButton" value="Next" />'
            .'<a href="../general-info/" class="button">Back</a>'
        )
    .'</form>'
);
