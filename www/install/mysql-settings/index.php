<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_general_info.php';
require_general_info();

include_once 'fns/get_values.php';
$values = get_values();

$host = $values['host'];
$username = $values['username'];
$password = $values['password'];
$db = $values['db'];
$create = $values['create'];

if ($values['check']) {

    include_once '../fns/check_mysql_config.php';
    $error = check_mysql_config($host, $username,
        $password, $db, $create, $mysqli, $focus);
    if ($focus === null) $focus = 'host';

    if ($error === null) $errorHtml = '';
    else $errorHtml = "<div class=\"error formError\">&times; $error</div>";

} else {
    $focus = 'host';
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
$nextSteps = ['Emergency User', 'Finalize Installation'];

include_once '../fns/echo_page.php';
include_once '../fns/field_columns.php';
include_once '../fns/steps.php';
include_once '../fns/wizard_layout.php';
echo_page(
    'Step 4 - MySQL Settings',
    '<form action="submit.php" method="post">'
        .wizard_layout(
            steps($doneSteps, 'MySQL Settings', $nextSteps),
            '<span class="title-step">Step 4</span>'
            .'<h2>MySQL Settings</h2>'
            .field_columns(
                '<label for="hostInput">Host:</label>'
                .'<br />'
                .'<input class="textfield" type="text"'
                .' required="required" name="host" id="hostInput"'
                .' value="'.htmlspecialchars($host).'"'
                .($focus == 'host' ? ' autofocus="autofocus"' : '').' />',
                '<label for="dbInput">Database:</label>'
                .'<br />'
                .'<input class="textfield" type="text"'
                .' name="db" id="dbInput" required="required"'
                .' value="'.htmlspecialchars($db).'"'
                .($focus == 'db' ? ' autofocus="autofocus"' : '').' />'
            )
            .field_columns(
                '<label for="usernameInput">Username:</label>'
                .'<br />'
                .'<input class="textfield" type="text"'
                .' name="username" id="usernameInput" required="required"'
                .' value="'.htmlspecialchars($username).'"'
                .($focus == 'username' ? ' autofocus="autofocus"' : '').' />',
                '<label for="passwordInput">Password:</label>'
                .'<br />'
                .'<input class="textfield" type="password"'
                .' name="password" id="passwordInput"'
                .' value="'.htmlspecialchars($password).'"'
                .($focus == 'password' ? ' autofocus="autofocus"' : '').' />'
            )
            .'<div>'
                .'<input type="checkbox" name="create" id="createInput"'
                .($create ? ' checked="checked"' : '').' />'
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
