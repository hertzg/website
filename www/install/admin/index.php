<?php

include_once '../fns/require_mysql_config.php';
require_mysql_config();

$key = 'install/admin/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'username' => 'adminadmin',
        'password1' => '',
        'password2' => '',
    ];
}

$key = 'install/admin/error';
if (array_key_exists($key, $_SESSION)) {
    $erroHtml =
        '<div class="error formError">'
            .htmlspecialchars($_SESSION[$key])
        .'</div>';
} else {
    $erroHtml = '';
}

$doneSteps = ['Requirements', 'General Information', 'MySQL Configuration'];

include_once '../fns/echo_page.php';
include_once '../fns/field_columns.php';
include_once '../fns/steps.php';
include_once '../fns/wizard_layout.php';
echo_page(
    'Step 4 - Administrator',
    '<form action="submit.php" method="post">'
        .wizard_layout(
            steps($doneSteps, 'Administrator', ['Finalize Installation']),
            '<span class="title-step">Step 4</span>'
            .'<h2>Administrator</h2>'
            .field_columns(
                '<label for="usernameInput">Username:</label>'
                .'<br />'
                .'<input class="textfield" type="text" required="required"'
                .' name="username" id="usernameInput" autofocus="autofocus"'
                .' value="'.htmlspecialchars($values['username']).'" />',
                ''
            )
            .field_columns(
                '<label for="password1Input">Password:</label>'
                .'<br />'
                .'<input class="textfield" type="password"'
                .' name="password1" id="password1Input" required="required"'
                .' value="'.htmlspecialchars($values['password1']).'" />',
                '<label for="password2Input">Repeat password:</label>'
                .'<br />'
                .'<input class="textfield" type="password"'
                .' name="password2" id="password2Input" required="required"'
                .' value="'.htmlspecialchars($values['password2']).'" />'
            )
            .$erroHtml,
            '<a href="../mysql-config/" class="button">Back</a>'
            .'<input type="submit" class="button nextButton" value="Next" />'
        )
    .'</form>'
);
